@extends('layouts.app')

@section('title', $ubicacion->name)

@section('content')

<a href="{{ route('ubicacions.index') }}" class="btn btn-secondary mb-3">
    ← Volver
</a>

<div class="card">
    <div class="card-body">
        <h3>{{ $ubicacion->name }}</h3>

        <p><strong>Provincia:</strong> {{ $ubicacion->provincia }}</p>
        <p><strong>Dirección:</strong> {{ $ubicacion->direccion }}</p>
        <p><strong>Dimensiones:</strong> {{ $ubicacion->alto }}m × {{ $ubicacion->ancho }}m</p>
        <p><strong>Líneas:</strong> {{ $ubicacion->n_lineas }}</p>
    </div>
</div>

@endsection
