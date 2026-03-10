@extends('layouts.app')
@section('title', 'Admin — Usuarios')

@section('content')
<div class="row g-4" x-data="{
        usuario: {},
        abrir(u) { this.usuario = u; }
     }">

<div class="col-auto">
    @include('admin.partials.sidebar')
</div>

<div class="col">

@if(session('status'))
    <div class="alert alert-success alert-dismissible fade show">{{ session('status') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

<h4 class="mb-3">Usuarios</h4>

{{-- Filtros --}}
<form method="GET" class="d-flex flex-wrap gap-2 mb-3" id="formFiltroUsuarios">
    <select name="rol" class="form-select" style="width:auto" onchange="this.form.submit()">
        <option value="todos"       @selected($rolFiltro==='todos')>Todos los roles</option>
        <option value="competidor"  @selected($rolFiltro==='competidor')>Competidor</option>
        <option value="entrenador"  @selected($rolFiltro==='entrenador')>Entrenador</option>
        <option value="arbitro"     @selected($rolFiltro==='arbitro')>Árbitro</option>
        <option value="admin"       @selected($rolFiltro==='admin')>Admin</option>
    </select>
    <input type="text" name="buscar" class="form-control" style="width:220px"
           placeholder="Buscar por nombre o DNI..." value="{{ $buscar }}"
           id="campoBuscar">
    <span class="text-muted small align-self-center">{{ $usuarios->count() }} usuarios</span>
</form>

<div class="card">
    <div class="card-body p-0" style="max-height:75vh; overflow-y:auto">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light sticky-top">
                <tr>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Provincia</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $u)
                    <tr>
                        <td class="fw-semibold">{{ $u->name }}</td>
                        <td class="text-muted small">{{ $u->dni ?? '—' }}</td>
                        <td class="text-muted small">{{ $u->email }}</td>
                        <td>
                            @php $bc = match($u->rol) { 'arbitro'=>'bg-warning text-dark','entrenador'=>'bg-success','admin'=>'bg-danger',default=>'bg-secondary' }; @endphp
                            <span class="badge {{ $bc }}">{{ $u->rol }}</span>
                        </td>
                        <td class="small">{{ $u->provincia ?? '—' }}</td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                            <button class="btn btn-sm btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditarUsuario"
                                    @click="abrir({{ Js::from([
                                        'id'               => $u->id,
                                        'name'             => $u->name,
                                        'email'            => $u->email,
                                        'dni'              => $u->dni ?? '',
                                        'fecha_nacimiento' => $u->fecha_nacimiento?->format('Y-m-d') ?? '',
                                        'provincia'        => $u->provincia ?? '',
                                        'talla'            => $u->talla ?? '',
                                        'genero'           => $u->genero ?? '',
                                        'rol'              => $u->rol,
                                    ]) }})">
                                Editar
                            </button>
                            <form method="POST" action="{{ route('admin.usuarios.destroy', $u->id) }}"
                                  onsubmit="return confirm('¿Eliminar a {{ addslashes($u->name) }}? Esta acción no se puede deshacer.')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No hay usuarios con ese filtro.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL EDITAR USUARIO --}}
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar usuario — <span x-text="usuario.name"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" :action="'/admin/usuarios/' + usuario.id">
                @csrf @method('PATCH')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nombre completo</label>
                            <input type="text" name="name" class="form-control" :value="usuario.name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" :value="usuario.email" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">DNI</label>
                            <input type="text" name="dni" class="form-control" :value="usuario.dni">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Fecha de nacimiento</label>
                            <input type="date" name="fecha_nacimiento" class="form-control" :value="usuario.fecha_nacimiento">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Provincia</label>
                            <select name="provincia" class="form-select">
                                <option value="">—</option>
                                @foreach(['Almería','Cádiz','Córdoba','Granada','Huelva','Jaén','Málaga','Sevilla','Madrid','Barcelona','Valencia','Otros'] as $prov)
                                    <option :selected="usuario.provincia === '{{ $prov }}'">{{ $prov }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Talla</label>
                            <select name="talla" class="form-select">
                                <option value="">—</option>
                                @foreach(['XS','S','M','L','XL','XXL'] as $t)
                                    <option :selected="usuario.talla === '{{ $t }}'">{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Género</label>
                            <select name="genero" class="form-select">
                                <option value="">—</option>
                                <option value="M" :selected="usuario.genero === 'M'">Masculino</option>
                                <option value="F" :selected="usuario.genero === 'F'">Femenino</option>
                                <option value="otro" :selected="usuario.genero === 'otro'">Otro</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Rol</label>
                            <select name="rol" class="form-select" required>
                                <option value="competidor" :selected="usuario.rol === 'competidor'">Competidor</option>
                                <option value="entrenador" :selected="usuario.rol === 'entrenador'">Entrenador</option>
                                <option value="arbitro"    :selected="usuario.rol === 'arbitro'">Árbitro</option>
                                <option value="admin"      :selected="usuario.rol === 'admin'">Admin</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>

</div>

<script>
// Búsqueda en tiempo real sin recargar (igual que antes)
document.getElementById('campoBuscar').addEventListener('input', function() {
    clearTimeout(this._t);
    this._t = setTimeout(() => document.getElementById('formFiltroUsuarios').submit(), 400);
});
</script>
@endsection
