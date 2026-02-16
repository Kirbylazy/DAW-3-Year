@extends('layouts.app')

@section('title', 'Ubicaciones')

@section('content')
<h3 class="mb-3">Ubicaciones</h3>

<div class="row g-3">
@foreach($ubicaciones as $u)
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5>{{ $u->name }}</h5>
                <p class="mb-1"><strong>Provincia:</strong> {{ $u->provincia }}</p>
                <p class="mb-2"><strong>Líneas:</strong> {{ $u->n_lineas }}</p>

                <a href="{{ route('ubicacions.show', $u->id) }}"
                   class="btn btn-sm btn-primary">
                   Ver detalles
                </a>
            </div>
        </div>
    </div>
@endforeach
</div>
@endsection
