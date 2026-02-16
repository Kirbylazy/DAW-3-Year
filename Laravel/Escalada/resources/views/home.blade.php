@extends('layouts.app')

@section('title','Inicio')

@section('content')
<div class="row g-3">
    <div class="col-md-4">
        <div class="card"><div class="card-body">
            <h6 class="text-muted">Copas</h6>
            <div class="fs-3">{{ $stats['copas'] }}</div>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card"><div class="card-body">
            <h6 class="text-muted">Competiciones</h6>
            <div class="fs-3">{{ $stats['competiciones'] }}</div>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card"><div class="card-body">
            <h6 class="text-muted">Ubicaciones</h6>
            <div class="fs-3">{{ $stats['ubicaciones'] }}</div>
        </div></div>
    </div>
</div>

<hr class="my-4">

<h4>Próximas competiciones</h4>
<div class="row g-3">
@foreach($proximas as $c)
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="text-muted small">{{ $c->fecha_realizacion->format('d/m/Y H:i') }}</div>
                <h5 class="card-title mb-1">{{ $c->name }}</h5>
                <div class="small">
                    <div><strong>Copa:</strong> {{ $c->copa->name ?? '-' }}</div>
                    <div><strong>Ubicación:</strong> {{ $c->ubicacion->name ?? '-' }}</div>
                </div>
                <a class="btn btn-sm btn-primary mt-3" href="{{ route('competicions.show', $c) }}">
                    Ver ficha
                </a>
            </div>
        </div>
    </div>
@endforeach
</div>
@endsection
