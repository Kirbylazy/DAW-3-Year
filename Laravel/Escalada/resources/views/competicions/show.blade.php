@extends('layouts.app')

@section('title', $competicion->name ?? 'Competición')

@section('content')

<a href="{{ route('competicions.index') }}" class="btn btn-secondary mb-3">
    ← Volver
</a>

<div class="card">
    <div class="card-body">

        {{-- Nombre --}}
        <h3 class="mb-2">
            {{ $competicion->name }}
        </h3>

        {{-- Fecha --}}
        <p class="text-muted">
            {{ $competicion->fecha_realizacion?->format('d/m/Y H:i') ?? 'Sin fecha' }}
        </p>

        <hr>

        {{-- Datos principales --}}
        <p>
            <strong>Copa:</strong>
            {{ $competicion->copa?->name ?? 'Sin copa' }}
        </p>

        <p>
            <strong>Provincia:</strong>
            {{ $competicion->provincia }}
        </p>

        <p>
            <strong>Tipo:</strong>
            {{ $competicion->tipo }}
        </p>

        <p>
            <strong>Campeonato:</strong>
            {{ $competicion->campeonato ? 'Sí' : 'No' }}
        </p>

        <hr>

        {{-- Ubicación --}}
        <h5>Ubicación</h5>

        @if($competicion->ubicacion)
            <p><strong>{{ $competicion->ubicacion->name }}</strong></p>
            <p>{{ $competicion->ubicacion->direccion }}</p>
            <p>{{ $competicion->ubicacion->provincia }}</p>
            <p>
                <small>
                    {{ $competicion->ubicacion->alto }}m alto ·
                    {{ $competicion->ubicacion->ancho }}m ancho ·
                    {{ $competicion->ubicacion->n_lineas }} líneas
                </small>
            </p>
        @else
            <p>Sin ubicación</p>
        @endif

    </div>
</div>

@endsection
