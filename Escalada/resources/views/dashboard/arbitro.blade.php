@extends('layouts.app')

@section('title', 'Dashboard — Árbitro')

@section('content')
<h3 class="mb-3">Bienvenido, árbitro {{ auth()->user()->name }}</h3>

<div class="alert alert-info mb-4">
    Desde aquí podrás gestionar las competiciones que te sean asignadas. Más funciones disponibles próximamente.
</div>

<h5 class="mb-3">Próximas competiciones</h5>

@if($competiciones->count() === 0)
    <div class="alert alert-secondary">
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
