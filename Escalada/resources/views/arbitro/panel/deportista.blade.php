@extends('layouts.app')
@section('title', 'Panel Árbitro — Deportista')

@section('content')
<div class="row g-4">

<div class="col-auto">
    @include('arbitro.partials.sidebar')
</div>

<div class="col">

<h4 class="mb-4">Mis inscripciones como deportista</h4>

<div class="card">
    <div class="card-body p-0">
        @if($misInscripciones->isEmpty())
            <p class="text-muted p-3 mb-0">No tienes inscripciones registradas.</p>
        @else
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Competición</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Copa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($misInscripciones as $c)
                        <tr>
                            <td>
                                {{ $c->name }}
                                @if($c->campeonato)
                                    <span class="badge bg-danger ms-1">Campeonato</span>
                                @endif
                            </td>
                            <td class="text-muted small">{{ $c->fecha_realizacion?->format('d/m/Y') ?? '—' }}</td>
                            <td><span class="badge bg-secondary">{{ $c->tipo }}</span></td>
                            <td>{{ $c->copa?->name ?? '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

</div>
</div>
@endsection
