@extends('layouts.app')

@section('title', $copa->name)

@section('content')

<a href="{{ route('copas.index') }}" class="btn btn-secondary mb-3">
    ← Volver
</a>

<div class="card">
    <div class="card-body">
        <h3>{{ $copa->name }}</h3>

        <p><strong>Tipo:</strong> {{ $copa->tipo }}</p>
        <p><strong>Temporada:</strong> {{ $copa->temporada }}</p>
    </div>
</div>

@endsection
