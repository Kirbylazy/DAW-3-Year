@extends('layouts.app')

@section('title', 'Copas')

@section('content')
<h3 class="mb-3">Copas</h3>

<div class="row g-3">
@foreach($copas as $c)
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5>{{ $c->name }}</h5>
                <p class="mb-1"><strong>Tipo:</strong> {{ $c->tipo }}</p>
                <p class="mb-2"><strong>Temporada:</strong> {{ $c->temporada }}</p>

                <a href="{{ route('copas.show', $c->id) }}"
                   class="btn btn-sm btn-primary">
                   Ver detalles
                </a>
            </div>
        </div>
    </div>
@endforeach
</div>
@endsection
