@extends('layouts.app')

@section('title', 'Gestión — ' . $competicion->name)

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">&larr; Volver al dashboard</a>
    <div>
        <h3 class="mb-0">{{ $competicion->name }}</h3>
        <div class="text-muted small">
            {{ $competicion->fecha_realizacion?->format('d/m/Y H:i') ?? '—' }}
            &nbsp;·&nbsp; {{ ucfirst($competicion->tipo) }}
            &nbsp;·&nbsp; {{ $competicion->provincia }}
            @if($competicion->campeonato)
                &nbsp;·&nbsp; <span class="badge bg-danger">Campeonato</span>
            @endif
        </div>
    </div>
</div>

{{-- Resumen total --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card text-center">
            <div class="card-body py-3">
                <div class="fs-2 fw-bold">{{ $totales['total'] }}</div>
                <div class="text-muted small">Total solicitudes</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center border-warning">
            <div class="card-body py-3">
                <div class="fs-2 fw-bold text-warning">{{ $totales['pendiente'] }}</div>
                <div class="text-muted small">Pendientes</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center border-success">
            <div class="card-body py-3">
                <div class="fs-2 fw-bold text-success">{{ $totales['aprobada'] }}</div>
                <div class="text-muted small">Aprobadas</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center border-danger">
            <div class="card-body py-3">
                <div class="fs-2 fw-bold text-danger">{{ $totales['rechazada'] }}</div>
                <div class="text-muted small">Rechazadas</div>
            </div>
        </div>
    </div>
</div>

{{-- Categorías --}}
<div class="card">
    <div class="card-header fw-semibold">Categorías</div>
    @if($categorias->isEmpty())
        <div class="card-body">
            <p class="text-muted mb-0">No hay inscripciones recibidas aún.</p>
        </div>
    @else
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Categoría</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Pendientes</th>
                        <th class="text-center">Aprobadas</th>
                        <th class="text-center">Rechazadas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorias as $nombre => $datos)
                        <tr>
                            <td class="fw-semibold">{{ $nombre }}</td>
                            <td class="text-center">{{ $datos['total'] }}</td>
                            <td class="text-center">
                                @if($datos['pendiente'] > 0)
                                    <span class="badge bg-warning text-dark">{{ $datos['pendiente'] }}</span>
                                @else
                                    <span class="text-muted">0</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($datos['aprobada'] > 0)
                                    <span class="badge bg-success">{{ $datos['aprobada'] }}</span>
                                @else
                                    <span class="text-muted">0</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($datos['rechazada'] > 0)
                                    <span class="badge bg-danger">{{ $datos['rechazada'] }}</span>
                                @else
                                    <span class="text-muted">0</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('arbitro.categoria', [$competicion->id, $nombre]) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    Ver competidores
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection
