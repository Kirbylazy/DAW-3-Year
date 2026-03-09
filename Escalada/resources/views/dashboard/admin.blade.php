@extends('layouts.app')

@section('title', 'Dashboard — Admin')

@section('content')
<h3 class="mb-4">Panel de administración</h3>

@if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card mb-4">
    <div class="card-header fw-semibold">Gestión de usuarios</div>
    <div class="card-body border-bottom pb-3">
        <input type="text" id="buscadorUsuarios" class="form-control"
               placeholder="Buscar por nombre o DNI...">
    </div>
    <div class="card-body p-0" style="max-height:800px; overflow-y:auto;">
        <table class="table table-hover mb-0">
            <thead class="table-light sticky-top">
                <tr>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Rol actual</th>
                    <th>Cambiar rol</th>
                </tr>
            </thead>
            <tbody id="tablaUsuarios">
                @forelse($usuarios as $u)
                    <tr data-nombre="{{ strtolower($u->name) }}" data-dni="{{ strtolower($u->dni ?? '') }}">
                        <td>{{ $u->name }}</td>
                        <td class="text-muted small">{{ $u->dni ?? '—' }}</td>
                        <td class="text-muted small">{{ $u->email }}</td>
                        <td>
                            @php
                                $badgeClass = match($u->rol) {
                                    'arbitro'    => 'bg-warning text-dark',
                                    'entrenador' => 'bg-success',
                                    'admin'      => 'bg-danger',
                                    default      => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ $u->rol }}</span>
                        </td>
                        <td>
                            <form method="POST"
                                  action="{{ route('admin.usuarios.rol', $u->id) }}"
                                  class="d-flex gap-2 align-items-center">
                                @csrf
                                @method('PATCH')
                                <select name="rol" class="form-select form-select-sm" style="width:auto">
                                    <option value="competidor"  @selected($u->rol === 'competidor')>Competidor</option>
                                    <option value="entrenador"  @selected($u->rol === 'entrenador')>Entrenador</option>
                                    <option value="arbitro"     @selected($u->rol === 'arbitro')>Árbitro</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-3">No hay usuarios.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
document.getElementById('buscadorUsuarios').addEventListener('input', function () {
    const q = this.value.toLowerCase().trim();
    document.querySelectorAll('#tablaUsuarios tr').forEach(function (fila) {
        const nombre = fila.dataset.nombre ?? '';
        const dni    = fila.dataset.dni    ?? '';
        fila.style.display = (!q || nombre.includes(q) || dni.includes(q)) ? '' : 'none';
    });
});
</script>


<div class="card mb-4">
    <div class="card-header fw-semibold">Gestión de competiciones — asignación de árbitros</div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Competición</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Árbitro asignado</th>
                    <th>Asignar árbitro</th>
                </tr>
            </thead>
            <tbody>
                @forelse($competiciones as $c)
                    <tr>
                        <td>
                            {{ $c->name }}
                            @if($c->campeonato)
                                <span class="badge bg-danger ms-1">Campeonato</span>
                            @endif
                        </td>
                        <td class="small text-muted">{{ $c->fecha_realizacion?->format('d/m/Y') ?? '—' }}</td>
                        <td><span class="badge bg-secondary">{{ $c->tipo }}</span></td>
                        <td>
                            @if($c->arbitro)
                                <span class="text-success fw-semibold">{{ $c->arbitro->name }}</span>
                            @else
                                <span class="text-muted">Sin asignar</span>
                            @endif
                        </td>
                        <td>
                            <form method="POST"
                                  action="{{ route('admin.competiciones.arbitro', $c->id) }}"
                                  class="d-flex gap-2 align-items-center">
                                @csrf
                                @method('PATCH')
                                <select name="arbitro_id" class="form-select form-select-sm" style="width:auto">
                                    <option value="">— Sin árbitro —</option>
                                    @foreach($arbitros as $a)
                                        <option value="{{ $a->id }}" @selected($c->arbitro_id === $a->id)>
                                            {{ $a->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button class="btn btn-sm btn-primary">Guardar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-3">No hay competiciones.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
