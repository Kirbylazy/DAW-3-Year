@extends('layouts.app')

@section('title', 'Competiciones')

@section('content')
<h3 class="mb-3">Competiciones</h3>

<div class="row g-3">
    @foreach($competiciones as $c)
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted small">
                        {{ $c->fecha_realizacion?->format('d/m/Y H:i') ?? 'Sin fecha' }}
                    </div>

                    <h5 class="card-title mb-2">{{ $c->name }}</h5>

                    <div class="small">
                        <div><strong>Copa:</strong> {{ $c->copa?->name ?? 'Sin copa' }}</div>
                        <div><strong>Provincia:</strong> {{ $c->provincia }}</div>
                        <div><strong>Tipo:</strong> {{ $c->tipo }}</div>
                    </div>

                    <a class="btn btn-sm btn-outline-primary mt-3"
                       href="{{ route('competicions.show', $c->id) }}">
                        Ver detalles
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-4">
    {{ $competiciones->links() }}
</div>
@endsection
