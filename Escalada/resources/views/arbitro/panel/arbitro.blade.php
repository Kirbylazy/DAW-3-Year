@extends('layouts.app')
@section('title', 'Panel Árbitro')

@section('content')
<div class="row g-4">

<div class="col-auto">
    @include('arbitro.partials.sidebar')
</div>

<div class="col">

<h4 class="mb-4">Mis competiciones asignadas</h4>

<div class="card">
    <div class="card-body p-0">
        @if($competicionesArbitradas->isEmpty())
            <p class="text-muted p-3 mb-0">No tienes ninguna competición asignada aún.</p>
        @else
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Competición</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Provincia</th>
                        <th>Copa</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($competicionesArbitradas as $c)
                        <tr>
                            <td>
                                {{ $c->name }}
                                @if($c->campeonato)
                                    <span class="badge bg-danger ms-1">Campeonato</span>
                                @endif
                            </td>
                            <td class="text-muted small">{{ $c->fecha_realizacion?->format('d/m/Y H:i') ?? '—' }}</td>
                            <td><span class="badge bg-secondary">{{ $c->tipo }}</span></td>
                            <td>{{ $c->provincia }}</td>
                            <td>{{ $c->copa?->name ?? '—' }}</td>
                            <td class="text-end">
                                <a href="{{ route('arbitro.competicion', $c->id) }}" class="btn btn-sm btn-primary">
                                    Gestionar inscripciones
                                </a>
                            </td>
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
