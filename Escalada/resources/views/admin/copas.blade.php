@extends('layouts.app')
@section('title', 'Admin — Copas')

@section('content')
<div class="row g-4" x-data="{
    copa: {},
    abrir(c) { this.copa = c; }
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

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Copas</h4>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearCopa">+ Crear Copa</button>
</div>

<form method="GET" class="mb-3">
    <select name="filtro" class="form-select" style="width:auto" onchange="this.form.submit()">
        <option value="todas"    @selected($filtro==='todas')>Todas las copas</option>
        <option value="este_año" @selected($filtro==='este_año')>Copas de este año ({{ now()->year }})</option>
    </select>
</form>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Temporada</th>
                    <th class="text-center">Pruebas</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($copas as $copa)
                    <tr>
                        <td class="fw-semibold">{{ $copa->name }}</td>
                        <td><span class="badge bg-secondary">{{ $copa->tipo }}</span></td>
                        <td>{{ $copa->temporada }}</td>
                        <td class="text-center">{{ $copa->competiciones_count }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm btn-outline-primary"
                                        data-bs-toggle="modal" data-bs-target="#modalEditarCopa"
                                        @click="abrir({{ Js::from(['id'=>$copa->id,'name'=>$copa->name,'tipo'=>$copa->tipo,'temporada'=>$copa->temporada]) }})">
                                    Editar
                                </button>
                                <form method="POST" action="{{ route('admin.copas.destroy', $copa->id) }}"
                                      onsubmit="return confirm('¿Eliminar «{{ addslashes($copa->name) }}»?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">No hay copas con ese filtro.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</div>

</div>

{{-- MODAL EDITAR COPA --}}
<div class="modal fade" id="modalEditarCopa" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog"
         x-data="{
            get nombreAuto() { return 'Copa Andaluza de ' + ({bloque:'Bloque',dificultad:'Dificultad',velocidad:'Velocidad'}[copa.tipo]||copa.tipo) + ' ' + copa.temporada; }
         }">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar copa — <span x-text="copa.name"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" :action="'/admin/copas/' + copa.id">
                @csrf @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tipo</label>
                        <select name="tipo" class="form-select" x-model="copa.tipo" required>
                            <option value="bloque">Bloque</option>
                            <option value="dificultad">Dificultad</option>
                            <option value="velocidad">Velocidad</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Temporada (año)</label>
                        <input type="number" name="temporada" class="form-control"
                               x-model="copa.temporada" min="2000" max="2100" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nombre</label>
                        <input type="text" name="name" class="form-control"
                               x-model="copa.name" maxlength="150" required>
                        <div class="form-text text-muted">
                            Nombre automático: <span x-text="nombreAuto"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL CREAR COPA --}}
<div class="modal fade" id="modalCrearCopa" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog"
         x-data="{
            tipo: 'bloque',
            temporada: '{{ now()->year }}',
            nombre: 'Copa Andaluza de Bloque {{ now()->year }}',
            nombreManual: false,
            tipoLabel(t) { return {bloque:'Bloque',dificultad:'Dificultad',velocidad:'Velocidad'}[t] ?? t; },
            actualizarNombre() { if (!this.nombreManual) this.nombre = 'Copa Andaluza de ' + this.tipoLabel(this.tipo) + ' ' + this.temporada; }
         }">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear nueva Copa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.copas.store') }}">
                @csrf
                <div class="modal-body">
                    @if($errors->any())
                        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tipo</label>
                        <select name="tipo" class="form-select" x-model="tipo" @change="actualizarNombre()" required>
                            <option value="bloque">Bloque</option>
                            <option value="dificultad">Dificultad</option>
                            <option value="velocidad">Velocidad</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Temporada (año)</label>
                        <input type="number" name="temporada" class="form-control"
                               x-model="temporada" @input="actualizarNombre()"
                               min="2000" max="2100" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Nombre <span class="fw-normal text-muted small">(se genera automáticamente)</span>
                        </label>
                        <input type="text" name="name" class="form-control"
                               x-model="nombre" @input="nombreManual=true" maxlength="150" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Crear Copa</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
