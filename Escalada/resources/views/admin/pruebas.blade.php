@extends('layouts.app')
@section('title', 'Admin — Pruebas')

@section('content')
<div class="row g-4">

{{-- Sidebar izquierdo --}}
<div class="col-auto">
    @include('admin.partials.sidebar')
</div>

{{-- Contenido principal --}}
<div class="col">

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Pruebas</h4>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearPrueba">+ Crear Prueba</button>
</div>

{{-- Filtros --}}
<form method="GET" class="d-flex flex-wrap gap-2 mb-3">
    <select name="filtro" class="form-select" style="width:auto" onchange="this.form.submit()">
        <option value="proximas" @selected($filtro==='proximas')>Próximas pruebas</option>
        <option value="este_año" @selected($filtro==='este_año')>Este año</option>
        <option value="todas"    @selected($filtro==='todas')>Todas</option>
    </select>
    <select name="copa_id" class="form-select" style="width:auto" onchange="this.form.submit()">
        <option value="">Todas las copas</option>
        <option value="sin_copa" @selected($copaId==='sin_copa')>Sin copa</option>
        @foreach($copas as $copa)
            <option value="{{ $copa->id }}" @selected($copaId == $copa->id)>{{ $copa->name }}</option>
        @endforeach
    </select>
</form>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Prueba</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Copa</th>
                    <th>Campeonato</th>
                    <th>Árbitro</th>
                    <th>Asignar árbitro</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($competiciones as $c)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $c->name }}</div>
                            @if($c->categorias)
                                <div class="text-muted small">{{ implode(', ', $c->categorias) }}</div>
                            @endif
                        </td>
                        <td class="small text-muted text-nowrap">
                            {{ $c->fecha_realizacion?->format('d/m/Y') ?? '—' }}
                            @if($c->fecha_fin)
                                <span class="text-muted">→ {{ $c->fecha_fin->format('d/m/Y') }}</span>
                            @endif
                        </td>
                        <td><span class="badge bg-secondary">{{ $c->tipo }}</span></td>
                        <td class="small">{{ $c->copa?->name ?? '—' }}</td>
                        <td>
                            @if($c->campeonato)
                                <span class="badge bg-danger me-1">Campeonato</span>
                            @endif
                            <form method="POST" action="{{ route('admin.competiciones.campeonato', $c->id) }}" class="d-inline">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm {{ $c->campeonato ? 'btn-outline-danger' : 'btn-outline-secondary' }}"
                                        onclick="return confirm('{{ $c->campeonato ? '¿Quitar campeonato?' : '¿Designar como campeonato?' }}')">
                                    {{ $c->campeonato ? 'Quitar' : 'Designar' }}
                                </button>
                            </form>
                        </td>
                        <td class="small">{{ $c->arbitro?->name ?? '—' }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.competiciones.arbitro', $c->id) }}" class="d-flex gap-1">
                                @csrf @method('PATCH')
                                <select name="arbitro_id" class="form-select form-select-sm" style="width:auto">
                                    <option value="">— Sin árbitro —</option>
                                    @foreach($arbitros as $a)
                                        <option value="{{ $a->id }}" @selected($c->arbitro_id === $a->id)>{{ $a->name }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-sm btn-primary">Guardar</button>
                            </form>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm btn-outline-primary"
                                        data-bs-toggle="modal" data-bs-target="#modalEditarPrueba"
                                        data-id="{{ $c->id }}"
                                        data-name="{{ $c->name }}"
                                        data-tipo="{{ $c->tipo }}"
                                        data-fecha="{{ $c->fecha_realizacion?->format('Y-m-d\TH:i') }}"
                                        data-fecha-fin="{{ $c->fecha_fin?->format('Y-m-d\TH:i') }}"
                                        data-provincia="{{ $c->provincia }}"
                                        data-ubicacion-id="{{ $c->ubicacion_id }}"
                                        data-copa-id="{{ $c->copa_id ?? '' }}"
                                        data-arbitro-id="{{ $c->arbitro_id ?? '' }}"
                                        data-categorias="{{ json_encode($c->categorias ?? []) }}">
                                    Editar
                                </button>
                                <form method="POST" action="{{ route('admin.competiciones.destroy', $c->id) }}"
                                      onsubmit="return confirm('¿Eliminar «{{ addslashes($c->name) }}»? Se eliminarán también todas sus inscripciones.')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">No hay pruebas con ese filtro.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</div>

</div>

{{-- MODAL EDITAR PRUEBA --}}
<div class="modal fade" id="modalEditarPrueba" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar prueba — <span id="editarPruebaNombreTitle"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="" id="editarPruebaForm">
                @csrf @method('PATCH')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Nombre</label>
                            <input type="text" name="name" id="editarPruebaName" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Tipo</label>
                            <select name="tipo" id="editarPruebaTipo" class="form-select" required>
                                <option value="bloque">Bloque</option>
                                <option value="dificultad">Dificultad</option>
                                <option value="velocidad">Velocidad</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Fecha inicio</label>
                            <input type="datetime-local" name="fecha_realizacion" id="editarPruebaFecha" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Fecha fin <span class="fw-normal text-muted">(opcional)</span></label>
                            <input type="datetime-local" name="fecha_fin" id="editarPruebaFechaFin" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Provincia</label>
                            <select name="provincia" id="editarPruebaProvincia" class="form-select" required>
                                <option value="">Selecciona...</option>
                                @foreach(['Almería','Cádiz','Córdoba','Granada','Huelva','Jaén','Málaga','Sevilla'] as $prov)
                                    <option value="{{ $prov }}">{{ $prov }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Rocódromo</label>
                            <select name="ubicacion_id" id="editarPruebaUbicacion" class="form-select" required>
                                <option value="">Selecciona...</option>
                                @foreach($ubicaciones as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }} — {{ $u->provincia }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Copa asociada</label>
                            <select name="copa_id" id="editarPruebaCopa" class="form-select">
                                <option value="">— Sin copa —</option>
                                @foreach($copas as $copa)
                                    <option value="{{ $copa->id }}">{{ $copa->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Árbitro</label>
                            <select name="arbitro_id" id="editarPruebaArbitro" class="form-select">
                                <option value="">— Sin árbitro —</option>
                                @foreach($arbitros as $a)
                                    <option value="{{ $a->id }}">{{ $a->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold d-block">Categorías <span class="fw-normal text-muted small">(masculino y femenino)</span></label>
                            <div class="d-flex flex-wrap gap-2" id="editarPruebaCategorias">
                                @foreach(\App\Models\Competicion::categoriasDisponibles() as $cat)
                                    <div class="form-check form-check-inline border rounded px-3 py-2 m-0">
                                        <input class="form-check-input" type="checkbox"
                                               name="categorias[]" value="{{ $cat }}"
                                               id="ecat_{{ $cat }}">
                                        <label class="form-check-label" for="ecat_{{ $cat }}">{{ $cat }}</label>
                                    </div>
                                @endforeach
                            </div>
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

<script>
document.getElementById('modalEditarPrueba').addEventListener('show.bs.modal', function (event) {
    const btn = event.relatedTarget;
    const categorias = JSON.parse(btn.dataset.categorias || '[]');

    document.getElementById('editarPruebaForm').action = '/admin/competiciones/' + btn.dataset.id;
    document.getElementById('editarPruebaNombreTitle').textContent = btn.dataset.name;
    document.getElementById('editarPruebaName').value = btn.dataset.name;
    document.getElementById('editarPruebaTipo').value = btn.dataset.tipo;
    document.getElementById('editarPruebaFecha').value = btn.dataset.fecha;
    document.getElementById('editarPruebaFechaFin').value = btn.dataset.fechaFin || '';
    document.getElementById('editarPruebaProvincia').value = btn.dataset.provincia;
    document.getElementById('editarPruebaUbicacion').value = btn.dataset.ubicacionId;
    document.getElementById('editarPruebaCopa').value = btn.dataset.copaId;
    document.getElementById('editarPruebaArbitro').value = btn.dataset.arbitroId;

    document.querySelectorAll('#editarPruebaCategorias input[type=checkbox]').forEach(function(cb) {
        cb.checked = categorias.includes(cb.value);
    });
});
</script>

{{-- MODAL CREAR PRUEBA --}}
<div class="modal fade" id="modalCrearPrueba" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg"
         x-data="{
            tipo: 'bloque', fecha: '', copaId: '', copaManual: false,
            copas: {{ Js::from($copas) }},
            get añoFecha() { return this.fecha ? new Date(this.fecha).getFullYear() : null; },
            get copaDetectada() {
                if (!this.añoFecha) return null;
                return this.copas.find(c => c.tipo === this.tipo && c.temporada == this.añoFecha) || null;
            },
            get copaDetectadaLabel() {
                if (this.copaDetectada) return 'Asociada automáticamente a: ' + this.copaDetectada.name;
                return this.añoFecha ? 'No hay copa de ' + this.tipo + ' para ' + this.añoFecha + '. Se creará sin copa.' : '';
            },
            sincronizarCopa() { if (!this.copaManual) this.copaId = this.copaDetectada ? String(this.copaDetectada.id) : ''; }
         }">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear nueva Prueba</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.competiciones.store') }}">
                @csrf
                <div class="modal-body">
                    @if($errors->any())
                        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
                    @endif
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Nombre</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                   placeholder="Ej: 1ª Prueba de Bloque de Andalucía, Sevilla" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Tipo</label>
                            <select name="tipo" class="form-select" x-model="tipo" @change="copaManual=false; sincronizarCopa()" required>
                                <option value="bloque">Bloque</option>
                                <option value="dificultad">Dificultad</option>
                                <option value="velocidad">Velocidad</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Fecha inicio</label>
                            <input type="datetime-local" name="fecha_realizacion" class="form-control"
                                   x-model="fecha" @change="copaManual=false; sincronizarCopa()"
                                   value="{{ old('fecha_realizacion') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Fecha fin <span class="fw-normal text-muted">(opcional)</span></label>
                            <input type="datetime-local" name="fecha_fin" class="form-control"
                                   value="{{ old('fecha_fin') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Provincia</label>
                            <select name="provincia" class="form-select" required>
                                <option value="">Selecciona...</option>
                                @foreach(['Almería','Cádiz','Córdoba','Granada','Huelva','Jaén','Málaga','Sevilla'] as $prov)
                                    <option value="{{ $prov }}" @selected(old('provincia')===$prov)>{{ $prov }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Rocódromo</label>
                            <select name="ubicacion_id" class="form-select" required>
                                <option value="">Selecciona...</option>
                                @foreach($ubicaciones as $u)
                                    <option value="{{ $u->id }}" @selected(old('ubicacion_id')==$u->id)>{{ $u->name }} — {{ $u->provincia }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Copa asociada</label>
                            <select name="copa_id" class="form-select" x-model="copaId" @change="copaManual=true">
                                <option value="">— Sin copa —</option>
                                @foreach($copas as $copa)
                                    <option value="{{ $copa->id }}" @selected(old('copa_id')==$copa->id)>{{ $copa->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-text" :class="copaDetectada ? 'text-success' : 'text-muted'" x-text="copaDetectadaLabel"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Árbitro <span class="fw-normal text-muted">(opcional)</span></label>
                            <select name="arbitro_id" class="form-select">
                                <option value="">— Sin árbitro —</option>
                                @foreach($arbitros as $a)
                                    <option value="{{ $a->id }}" @selected(old('arbitro_id')==$a->id)>{{ $a->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold d-block">Categorías <span class="fw-normal text-muted small">(masculino y femenino)</span></label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach(\App\Models\Competicion::categoriasDisponibles() as $cat)
                                    <div class="form-check form-check-inline border rounded px-3 py-2 m-0">
                                        <input class="form-check-input" type="checkbox" name="categorias[]"
                                               value="{{ $cat }}" id="pcat_{{ $cat }}"
                                               @checked(in_array($cat, old('categorias', [])))>
                                        <label class="form-check-label" for="pcat_{{ $cat }}">{{ $cat }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-2 d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                        onclick="document.querySelectorAll('#modalCrearPrueba [name=\'categorias[]\']').forEach(c=>c.checked=true)">Todas</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                        onclick="document.querySelectorAll('#modalCrearPrueba [name=\'categorias[]\']').forEach(c=>c.checked=false)">Ninguna</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Prueba</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
