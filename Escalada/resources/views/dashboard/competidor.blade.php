@extends('layouts.app')

@section('title', 'Dashboard — Competidor')

@section('content')

{{-- Notificaciones de inscripción (árbitro) --}}
@foreach($notificaciones as $notif)
    @if($notif->data['tipo'] === 'inscripcion_actualizada')
        @if($notif->data['estado'] === 'aprobada')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>¡Inscripción aprobada!</strong>
                Tu inscripción en <strong>{{ $notif->data['competicion'] }}</strong> ha sido verificada y aprobada.
                <a href="{{ route('competiciones.show', $notif->data['competicion_id']) }}" class="alert-link ms-2">Ver competición</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @else
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Inscripción rechazada.</strong>
                <strong>{{ $notif->data['competicion'] }}</strong>:
                {{ $notif->data['motivo'] ?? 'Documentación no válida.' }}
                <a href="{{ route('competiciones.show', $notif->data['competicion_id']) }}" class="alert-link ms-2">Volver a intentarlo</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    @endif
@endforeach

{{-- Solicitudes de entrenador pendientes --}}
@if($notificaciones->where('data.tipo', 'solicitud_entrenador')->isNotEmpty())
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
    <div class="alert alert-info d-flex justify-content-between align-items-center mb-4">
        <span>Tu entrenador es <strong>{{ $entrenador->name }}</strong>.</span>
        <form method="POST" action="{{ route('notificaciones.desvincular') }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-outline-danger">Desvincularme</button>
        </form>
    </div>
@endif

{{-- Competiciones --}}
<h3 class="mb-3">Competiciones</h3>

@if($competiciones->count() === 0)
    <div class="alert alert-info">No hay competiciones disponibles.</div>
@else
    <div class="row g-3">
        @foreach($competiciones as $c)
            @php
                $ins    = $inscripciones[$c->id] ?? null;
                $estado = $ins?->estado ?? 'sin_inscripcion';
                $esPasada = $c->fecha_realizacion?->isPast() ?? false;
            @endphp
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 {{ $estado === 'aprobada' ? 'border-success' : ($estado === 'rechazada' ? 'border-danger' : '') }}">
                    <div class="card-body d-flex flex-column">

                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <div class="text-muted small">
                                {{ $c->fecha_realizacion?->format('d/m/Y') ?? 'Sin fecha' }}
                                @if($esPasada)
                                    <span class="badge bg-secondary ms-1">Pasada</span>
                                @endif
                            </div>
                            @if($c->campeonato)
                                <span class="badge bg-danger">Campeonato</span>
                            @endif
                        </div>

                        <h5 class="card-title mb-2">{{ $c->name }}</h5>

                        <div class="small mb-3">
                            <div><strong>Tipo:</strong> {{ ucfirst($c->tipo) }}</div>
                            <div><strong>Copa:</strong> {{ $c->copa?->name ?? '—' }}</div>
                            <div><strong>Ubicación:</strong> {{ $c->ubicacion?->name ?? '—' }}</div>
                        </div>

                        {{-- Estado de inscripción --}}
                        <div class="mt-auto">
                            @if($estado === 'aprobada')
                                <span class="badge bg-success fs-6 d-block text-center py-2 mb-2">
                                    Inscripción aprobada
                                </span>
                            @elseif($estado === 'pendiente')
                                <span class="badge bg-warning text-dark fs-6 d-block text-center py-2 mb-2">
                                    Pendiente de revisión
                                </span>
                            @elseif($estado === 'rechazada')
                                <span class="badge bg-danger fs-6 d-block text-center py-2 mb-2">
                                    Inscripción rechazada
                                </span>
                            @endif

                            <a href="{{ route('competiciones.show', $c->id) }}"
                               class="btn btn-sm w-100 {{ $estado === 'aprobada' ? 'btn-success' : ($estado === 'rechazada' ? 'btn-danger' : 'btn-outline-primary') }}">
                                @if($estado === 'aprobada')
                                    Ver mi inscripción
                                @elseif($estado === 'pendiente')
                                    Ver estado
                                @elseif($estado === 'rechazada')
                                    Reinscribirme
                                @elseif(!$esPasada)
                                    Inscribirme
                                @else
                                    Ver detalles
                                @endif
                            </a>
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
