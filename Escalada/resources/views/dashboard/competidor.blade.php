@extends('layouts.app')

@section('title', 'Dashboard — Competidor')

@section('content')

{{-- Solicitudes de entrenador pendientes --}}
@if($notificaciones->isNotEmpty())
    <div class="card mb-4 border-warning">
        <div class="card-header bg-warning text-dark fw-semibold">
            Solicitudes de entrenador
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @foreach($notificaciones as $notif)
                    @if($notif->data['tipo'] === 'solicitud_entrenador')
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $notif->data['mensaje'] }}</span>
                            <div class="d-flex gap-2">
                                <form method="POST" action="{{ route('notificaciones.aceptar', $notif->id) }}">
                                    @csrf
                                    <button class="btn btn-sm btn-success">Aceptar</button>
                                </form>
                                <form method="POST" action="{{ route('notificaciones.rechazar', $notif->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Rechazar</button>
                                </form>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endif

{{-- Entrenador actual --}}
@if($entrenador)
    <div class="alert alert-info d-flex justify-content-between align-items-center">
        <span>Tu entrenador es <strong>{{ $entrenador->name }}</strong>.</span>
        <form method="POST" action="{{ route('notificaciones.desvincular') }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-outline-danger">Desvincularme</button>
        </form>
    </div>
@endif

<h3 class="mb-3">Próximas competiciones</h3>

@if($competiciones->count() === 0)
    <div class="alert alert-info">
        No hay competiciones futuras ahora mismo.
    </div>
@else
    <div class="row g-3">
        @foreach($competiciones as $c)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="text-muted small">
                            {{ $c->fecha_realizacion?->format('d/m/Y H:i') ?? 'Sin fecha' }}
                        </div>

                        <h5 class="card-title mb-2">{{ $c->name }}</h5>

                        <div class="small">
                            <div><strong>Provincia:</strong> {{ $c->provincia }}</div>
                            <div><strong>Tipo:</strong> {{ $c->tipo }}</div>
                            <div><strong>Copa:</strong> {{ $c->copa?->name ?? '—' }}</div>
                            <div><strong>Ubicación:</strong> {{ $c->ubicacion?->name ?? '—' }}</div>
                        </div>

                        <div class="d-flex gap-2 mt-3">
                            @if(\Illuminate\Support\Facades\Route::has('competiciones.show'))
                                <a class="btn btn-sm btn-outline-primary"
                                   href="{{ route('competiciones.show', $c->id) }}">
                                    Ver
                                </a>
                            @endif

                            <button class="btn btn-sm btn-primary" disabled>
                                Inscribirme (próximamente)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $competiciones->links() }}
    </div>
@endif
@endsection
