@extends('layouts.app')

@section('title', $categoria . ' — ' . $competicion->name)

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
@endif

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('arbitro.competicion', $competicion->id) }}" class="btn btn-outline-secondary btn-sm">&larr; Volver a categorías</a>
    <div>
        <h3 class="mb-0">{{ $categoria }}</h3>
        <div class="text-muted small">{{ $competicion->name }}</div>
    </div>
</div>

@if($inscripciones->isEmpty())
    <div class="alert alert-info">No hay inscripciones en esta categoría.</div>
@else
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Competidor</th>
                        <th>DNI</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                        <th>Documentos</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inscripciones as $ins)
                        <tr>
                            <td class="fw-semibold">{{ $ins->user->name }}</td>
                            <td class="text-muted">{{ $ins->user->dni }}</td>
                            <td>
                                {{-- Cambio de categoría inline --}}
                                <form method="POST"
                                      action="{{ route('arbitro.cambiar_categoria', $ins->id) }}"
                                      class="d-flex gap-1 align-items-center">
                                    @csrf
                                    @method('PATCH')
                                    <select name="categoria" class="form-select form-select-sm" style="min-width:160px"
                                            onchange="this.form.submit()">
                                        @foreach(\App\Models\Inscripcion::listaCategorias() as $cat)
                                            <option value="{{ $cat }}" {{ $ins->categoria === $cat ? 'selected' : '' }}>
                                                {{ $cat }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td>
                                @if($ins->estado === 'pendiente')
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                @elseif($ins->estado === 'aprobada')
                                    <span class="badge bg-success">Aprobada</span>
                                @elseif($ins->estado === 'rechazada')
                                    <span class="badge bg-danger">Rechazada</span>
                                @endif
                                {{-- Detalle por documento --}}
                                @php
                                    $badgeDoc = fn(?string $e) => match($e) {
                                        'valida'     => ['bg-success', 'Válida'],
                                        'valida_dia' => ['bg-warning text-dark', 'Válida 1 día'],
                                        'no_valida'  => ['bg-danger', 'No válida'],
                                        default      => ['bg-secondary', 'Pendiente'],
                                    };
                                    [$clsL, $lblL] = $badgeDoc($ins->licencia_estado);
                                    [$clsP, $lblP] = $badgeDoc($ins->pago_estado);
                                @endphp
                                <div class="mt-1" style="font-size:0.72rem">
                                    <span class="badge {{ $clsL }}">Lic: {{ $lblL }}</span>
                                    <span class="badge {{ $clsP }} ms-1">Pago: {{ $lblP }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-1 flex-wrap">
                                    @if($ins->licencia_path)
                                        <a href="{{ route('arbitro.ver_documento', [$ins->id, 'licencia']) }}"
                                           target="_blank" class="btn btn-sm btn-outline-secondary">Licencia</a>
                                    @else
                                        <span class="text-muted small">Sin licencia</span>
                                    @endif
                                    @if($ins->pago_path)
                                        <a href="{{ route('arbitro.ver_documento', [$ins->id, 'pago']) }}"
                                           target="_blank" class="btn btn-sm btn-outline-secondary">Justificante</a>
                                    @else
                                        <span class="text-muted small">Sin justificante</span>
                                    @endif
                                </div>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal-validar-{{ $ins->id }}">
                                    Verificar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modales de verificación --}}
    @foreach($inscripciones as $ins)
        <div class="modal fade" id="modal-validar-{{ $ins->id }}" tabindex="-1"
             aria-labelledby="modal-label-{{ $ins->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content"
                     x-data="{
                        licDecision: '',
                        pagoDecision: '',
                        licMotivoInput: '',
                        pagoMotivoInput: '',
                        licEstado: {{ Js::from($ins->licencia_estado) }},
                        pagoEstado: {{ Js::from($ins->pago_estado) }},
                        licMotivo: {{ Js::from($ins->licencia_motivo) }},
                        pagoMotivo: {{ Js::from($ins->pago_motivo) }},
                        licAnual: {{ Js::from(isset($licenciasAnuales[$ins->user_id]) ? $licenciasAnuales[$ins->user_id]->valida_hasta->format('d/m/Y') : null) }},
                        msg: '',
                        msgType: 'success',
                        loading: false,

                        badgeClass(e) {
                            if (e === 'valida' || e === 'valida_dia') return 'bg-success';
                            if (e === 'no_valida') return 'bg-danger';
                            return 'bg-secondary';
                        },
                        badgeLabel(e, isPago) {
                            if (e === 'valida' || e === 'valida_dia') return isPago ? 'Válido' : 'Válida';
                            if (e === 'no_valida') return isPago ? 'No válido' : 'No válida';
                            return 'Pendiente';
                        },

                        async verificar(tipo) {
                            const decision = tipo === 'licencia' ? this.licDecision : this.pagoDecision;
                            const motivo   = tipo === 'licencia' ? this.licMotivoInput : this.pagoMotivoInput;

                            if (!decision) return;
                            if (decision === 'no_valida' && !motivo.trim()) {
                                this.msg = 'Debes escribir un motivo de rechazo.';
                                this.msgType = 'danger';
                                return;
                            }

                            this.loading = true;
                            this.msg = '';

                            try {
                                const resp = await fetch('{{ route('arbitro.validar_licencia', $ins->id) }}', {
                                    method: 'PATCH',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'Accept': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                    },
                                    body: JSON.stringify({ tipo, decision, motivo: motivo || null })
                                });
                                const data = await resp.json();

                                if (data.success) {
                                    if (tipo === 'licencia') {
                                        this.licEstado   = decision;
                                        this.licMotivo   = decision === 'no_valida' ? motivo : null;
                                        this.licDecision = '';
                                        this.licMotivoInput = '';
                                    } else {
                                        this.pagoEstado   = decision;
                                        this.pagoMotivo   = decision === 'no_valida' ? motivo : null;
                                        this.pagoDecision = '';
                                        this.pagoMotivoInput = '';
                                    }
                                    this.msg     = data.message;
                                    this.msgType = 'success';
                                } else {
                                    this.msg     = 'Error al guardar.';
                                    this.msgType = 'danger';
                                }
                            } catch (e) {
                                this.msg     = 'Error de conexión.';
                                this.msgType = 'danger';
                            }

                            this.loading = false;
                        }
                     }">

                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-label-{{ $ins->id }}">
                            Verificar inscripción — {{ $ins->user->name }}
                            <small class="text-muted fs-6 ms-2">{{ $ins->user->dni }}</small>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        {{-- Mensaje de resultado --}}
                        <div x-show="msg !== ''" x-cloak
                             :class="'alert alert-' + msgType + ' py-2 small'"
                             x-text="msg"></div>

                        {{-- ── 1. LICENCIA FEDERATIVA ─────────────────────── --}}
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="mb-0">1. Licencia federativa</h6>
                            <span class="badge" :class="badgeClass(licEstado)" x-text="badgeLabel(licEstado, false)"></span>
                        </div>

                        {{-- Licencia anual ya verificada en otra competición --}}
                        <template x-if="licAnual">
                            <div class="alert alert-success py-2 small mb-3">
                                Licencia verificada en una competición anterior. Válida hasta
                                <strong x-text="licAnual"></strong>. No es necesario verificarla de nuevo.
                            </div>
                        </template>

                        <template x-if="!licAnual">
                            <div>
                                <div x-show="licMotivo" x-cloak class="alert alert-danger py-1 small mb-2" x-text="licMotivo"></div>

                                <div class="mb-3">
                                    @if($ins->licencia_path)
                                        <a href="{{ route('arbitro.ver_documento', [$ins->id, 'licencia']) }}"
                                           target="_blank" class="btn btn-sm btn-outline-primary">
                                            Abrir licencia federativa
                                        </a>
                                    @else
                                        <span class="text-danger small">No hay licencia adjunta</span>
                                    @endif
                                </div>

                                <div class="d-flex gap-2 mb-2 flex-wrap">
                                    <button type="button" class="btn btn-sm"
                                            :class="licDecision==='valida' ? 'btn-success' : 'btn-outline-success'"
                                            @click="licDecision='valida'">
                                        Válida
                                        <small class="d-block" style="font-size:0.68rem">Hasta fin de año</small>
                                    </button>
                                    <button type="button" class="btn btn-sm"
                                            :class="licDecision==='valida_dia' ? 'btn-warning' : 'btn-outline-warning'"
                                            @click="licDecision='valida_dia'">
                                        Válida por un día
                                        <small class="d-block" style="font-size:0.68rem">Solo esta competición</small>
                                    </button>
                                    <button type="button" class="btn btn-sm"
                                            :class="licDecision==='no_valida' ? 'btn-danger' : 'btn-outline-danger'"
                                            @click="licDecision='no_valida'">
                                        No válida
                                    </button>
                                </div>

                                <div x-show="licDecision==='no_valida'" x-cloak class="mb-2">
                                    <textarea x-model="licMotivoInput" class="form-control form-control-sm" rows="2"
                                              placeholder="Motivo del rechazo..."></textarea>
                                </div>

                                <div x-show="licDecision!==''" x-cloak class="mb-1">
                                    <button type="button" class="btn btn-sm btn-primary"
                                            :disabled="loading"
                                            @click="verificar('licencia')">
                                        <span x-show="loading" class="spinner-border spinner-border-sm me-1"></span>
                                        Confirmar licencia
                                    </button>
                                </div>
                            </div>
                        </template>

                        <hr class="my-4">

                        {{-- ── 2. JUSTIFICANTE DE PAGO ────────────────────── --}}
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="mb-0">2. Justificante de pago</h6>
                            <span class="badge" :class="badgeClass(pagoEstado)" x-text="badgeLabel(pagoEstado, true)"></span>
                        </div>

                        <div x-show="pagoMotivo" x-cloak class="alert alert-danger py-1 small mb-2" x-text="pagoMotivo"></div>

                        <div class="mb-3">
                            @if($ins->pago_path)
                                <a href="{{ route('arbitro.ver_documento', [$ins->id, 'pago']) }}"
                                   target="_blank" class="btn btn-sm btn-outline-primary">
                                    Abrir justificante de pago
                                </a>
                            @else
                                <span class="text-danger small">No hay justificante adjunto</span>
                            @endif
                        </div>

                        <div class="d-flex gap-2 mb-2">
                            <button type="button" class="btn btn-sm"
                                    :class="pagoDecision==='valida' ? 'btn-success' : 'btn-outline-success'"
                                    @click="pagoDecision='valida'">
                                Válido
                            </button>
                            <button type="button" class="btn btn-sm"
                                    :class="pagoDecision==='no_valida' ? 'btn-danger' : 'btn-outline-danger'"
                                    @click="pagoDecision='no_valida'">
                                No válido
                            </button>
                        </div>

                        <div x-show="pagoDecision==='no_valida'" x-cloak class="mb-2">
                            <textarea x-model="pagoMotivoInput" class="form-control form-control-sm" rows="2"
                                      placeholder="Motivo del rechazo..."></textarea>
                        </div>

                        <div x-show="pagoDecision!==''" x-cloak class="mb-1">
                            <button type="button" class="btn btn-sm btn-primary"
                                    :disabled="loading"
                                    @click="verificar('pago')">
                                <span x-show="loading" class="spinner-border spinner-border-sm me-1"></span>
                                Confirmar justificante
                            </button>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

@endsection

@section('scripts')
<script>
    document.addEventListener('hidden.bs.modal', () => location.reload());
</script>
@endsection
