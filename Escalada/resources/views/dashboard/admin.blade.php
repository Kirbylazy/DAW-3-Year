@extends('layouts.app')

@section('title', 'Dashboard — Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Panel de administración</h3>
    <div class="d-flex gap-2">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearCopa">
            + Crear Copa
        </button>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearPrueba">
            + Crear Prueba
        </button>
    </div>
</div>

@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
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
    <div class="card-header fw-semibold">Gestión de competiciones</div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>Competición</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Copa</th>
                    <th>Campeonato</th>
                    <th>Árbitro asignado</th>
                    <th>Asignar árbitro</th>
                </tr>
            </thead>
            <tbody>
                @forelse($competiciones as $c)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $c->name }}</div>
                            @if($c->categorias)
                                <div class="text-muted small">
                                    {{ implode(', ', $c->categorias) }}
                                </div>
                            @endif
                        </td>
                        <td class="small text-muted">{{ $c->fecha_realizacion?->format('d/m/Y') ?? '—' }}</td>
                        <td><span class="badge bg-secondary">{{ $c->tipo }}</span></td>
                        <td class="small">{{ $c->copa?->name ?? '—' }}</td>
                        <td>
                            @if($c->campeonato)
                                <span class="badge bg-danger me-1">Campeonato</span>
                            @endif
                            <form method="POST"
                                  action="{{ route('admin.competiciones.campeonato', $c->id) }}"
                                  class="d-inline">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm {{ $c->campeonato ? 'btn-outline-danger' : 'btn-outline-secondary' }}"
                                        onclick="return confirm('{{ $c->campeonato ? '¿Quitar campeonato?' : '¿Designar como campeonato?' }}')">
                                    {{ $c->campeonato ? 'Quitar' : 'Designar' }}
                                </button>
                            </form>
                        </td>
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
                                @csrf @method('PATCH')
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
                        <td colspan="7" class="text-center text-muted py-3">No hay competiciones.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{-- ── MODAL CREAR PRUEBA ───────────────────────────────────────────── --}}
<div class="modal fade" id="modalCrearPrueba" tabindex="-1" aria-labelledby="modalCrearPruebaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"
         x-data="{
            tipo: 'bloque',
            fecha: '',
            copaId: '',
            copaManual: false,
            copas: {{ Js::from($copas) }},

            get añoFecha() {
                return this.fecha ? new Date(this.fecha).getFullYear() : null;
            },
            get copaDetectada() {
                if (!this.añoFecha) return null;
                return this.copas.find(c => c.tipo === this.tipo && c.temporada == this.añoFecha) || null;
            },
            get copaDetectadaLabel() {
                if (this.copaDetectada) return '✓ Asociada automáticamente a: ' + this.copaDetectada.name;
                return this.añoFecha ? 'No hay copa de ' + this.tipo + ' para ' + this.añoFecha + '. Se creará sin copa.' : '';
            },
            sincronizarCopa() {
                if (!this.copaManual) {
                    this.copaId = this.copaDetectada ? String(this.copaDetectada.id) : '';
                }
            }
         }">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCrearPruebaLabel">Crear nueva Prueba</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.competiciones.store') }}">
                @csrf
                <div class="modal-body">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row g-3">

                        {{-- Nombre --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold">Nombre de la prueba</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name') }}"
                                   placeholder="Ej: 1ª Prueba de Bloque de Andalucía, Sevilla" required>
                        </div>

                        {{-- Tipo --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Tipo</label>
                            <select name="tipo" class="form-select"
                                    x-model="tipo"
                                    @change="copaManual = false; sincronizarCopa()" required>
                                <option value="bloque">Bloque</option>
                                <option value="dificultad">Dificultad</option>
                                <option value="velocidad">Velocidad</option>
                            </select>
                        </div>

                        {{-- Fecha --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Fecha y hora</label>
                            <input type="datetime-local" name="fecha_realizacion" class="form-control"
                                   x-model="fecha"
                                   @change="copaManual = false; sincronizarCopa()"
                                   value="{{ old('fecha_realizacion') }}" required>
                        </div>

                        {{-- Provincia --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Provincia</label>
                            <select name="provincia" class="form-select" required>
                                <option value="">Selecciona...</option>
                                @foreach(['Almería','Cádiz','Córdoba','Granada','Huelva','Jaén','Málaga','Sevilla'] as $prov)
                                    <option value="{{ $prov }}" @selected(old('provincia') === $prov)>{{ $prov }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Ubicación --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Ubicación (rocódromo)</label>
                            <select name="ubicacion_id" class="form-select" required>
                                <option value="">Selecciona...</option>
                                @foreach($ubicaciones as $u)
                                    <option value="{{ $u->id }}" @selected(old('ubicacion_id') == $u->id)>
                                        {{ $u->name }} — {{ $u->provincia }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Copa --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Copa asociada</label>
                            <select name="copa_id" class="form-select"
                                    x-model="copaId"
                                    @change="copaManual = true">
                                <option value="">— Sin copa —</option>
                                @foreach($copas as $copa)
                                    <option value="{{ $copa->id }}"
                                            data-tipo="{{ $copa->tipo }}"
                                            data-año="{{ $copa->temporada }}"
                                            @selected(old('copa_id') == $copa->id)>
                                        {{ $copa->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text" :class="copaDetectada ? 'text-success' : 'text-muted'"
                                 x-text="copaDetectadaLabel"></div>
                        </div>

                        {{-- Árbitro --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Árbitro <span class="fw-normal text-muted">(opcional)</span></label>
                            <select name="arbitro_id" class="form-select">
                                <option value="">— Sin árbitro —</option>
                                @foreach($arbitros as $a)
                                    <option value="{{ $a->id }}" @selected(old('arbitro_id') == $a->id)>
                                        {{ $a->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Categorías --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold d-block">
                                Categorías participantes
                                <span class="fw-normal text-muted small">(siempre masculino y femenino)</span>
                            </label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach(\App\Models\Competicion::categoriasDisponibles() as $cat)
                                    <div class="form-check form-check-inline border rounded px-3 py-2 m-0">
                                        <input class="form-check-input" type="checkbox"
                                               name="categorias[]"
                                               value="{{ $cat }}"
                                               id="cat_{{ $cat }}"
                                               @checked(in_array($cat, old('categorias', [])))>
                                        <label class="form-check-label" for="cat_{{ $cat }}">{{ $cat }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                        onclick="document.querySelectorAll('#modalCrearPrueba [name=\'categorias[]\']').forEach(c=>c.checked=true)">
                                    Todas
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-1"
                                        onclick="document.querySelectorAll('#modalCrearPrueba [name=\'categorias[]\']').forEach(c=>c.checked=false)">
                                    Ninguna
                                </button>
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

{{-- ── MODAL CREAR COPA ─────────────────────────────────────────────── --}}
<div class="modal fade" id="modalCrearCopa" tabindex="-1" aria-labelledby="modalCrearCopaLabel" aria-hidden="true">
    <div class="modal-dialog"
         x-data="{
            tipo: 'bloque',
            temporada: '{{ now()->year }}',
            nombre: 'Copa Andaluza de Bloque {{ now()->year }}',
            nombreManual: false,

            tipoLabel(t) {
                return { bloque: 'Bloque', dificultad: 'Dificultad', velocidad: 'Velocidad' }[t] ?? t;
            },
            actualizarNombre() {
                if (!this.nombreManual) {
                    this.nombre = 'Copa Andaluza de ' + this.tipoLabel(this.tipo) + ' ' + this.temporada;
                }
            }
         }">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCrearCopaLabel">Crear nueva Copa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.copas.store') }}">
                @csrf
                <div class="modal-body">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Tipo --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tipo de copa</label>
                        <select name="tipo" class="form-select"
                                x-model="tipo"
                                @change="actualizarNombre()" required>
                            <option value="bloque">Bloque</option>
                            <option value="dificultad">Dificultad</option>
                            <option value="velocidad">Velocidad</option>
                        </select>
                    </div>

                    {{-- Temporada --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Temporada (año)</label>
                        <input type="number" name="temporada" class="form-control"
                               x-model="temporada"
                               @input="actualizarNombre()"
                               min="2000" max="2100"
                               value="{{ now()->year }}" required>
                    </div>

                    {{-- Nombre --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Nombre
                            <span class="text-muted fw-normal small">(se genera automáticamente, puedes cambiarlo)</span>
                        </label>
                        <input type="text" name="name" class="form-control"
                               x-model="nombre"
                               @input="nombreManual = true"
                               maxlength="150" required>
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
