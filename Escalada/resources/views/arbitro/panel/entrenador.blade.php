@extends('layouts.app')
@section('title', 'Panel Árbitro — Entrenador')

@section('content')
<div class="row g-4">

<div class="col-auto">
    @include('arbitro.partials.sidebar')
</div>

<div class="col">

{{-- Mi equipo --}}
<div class="card mb-4">
    <div class="card-header fw-semibold">
        Mi equipo <span class="badge bg-success ms-1">Entrenador</span>
    </div>
    <div class="card-body p-0">
        @if($competidores->isEmpty())
            <p class="text-muted p-3 mb-0">Aún no tienes competidores en tu equipo.</p>
        @else
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr><th>Nombre</th><th>DNI</th><th>Provincia</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach($competidores as $comp)
                        <tr>
                            <td>{{ $comp->name }}</td>
                            <td class="text-muted">{{ $comp->dni }}</td>
                            <td>{{ $comp->provincia }}</td>
                            <td class="text-end">
                                <form method="POST" action="{{ route('entrenador.eliminar_competidor', $comp->id) }}"
                                      onsubmit="return confirm('¿Desvincular a {{ $comp->name }}?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Desvincular</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

{{-- Solicitudes pendientes --}}
@if($pendientes->isNotEmpty())
<div class="card mb-4 border-secondary">
    <div class="card-header fw-semibold text-muted">Solicitudes enviadas (pendientes)</div>
    <div class="card-body p-0">
        <ul class="list-group list-group-flush">
            @foreach($pendientes as $p)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $p->name }} <span class="text-muted small">({{ $p->dni }})</span></span>
                    <form method="POST" action="{{ route('entrenador.eliminar_competidor', $p->id) }}"
                          onsubmit="return confirm('¿Cancelar la solicitud?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-secondary">Cancelar</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif

{{-- Añadir competidor por DNI --}}
<div class="card mb-4">
    <div class="card-header fw-semibold">Añadir competidor por DNI</div>
    <div class="card-body">
        <form method="GET" action="{{ route('arbitro.panel.entrenador') }}" class="d-flex gap-2 mb-0">
            <input type="text" name="dni" class="form-control" style="max-width:220px"
                   placeholder="DNI del competidor" value="{{ request('dni') }}">
            <button class="btn btn-outline-primary">Buscar</button>
        </form>

        @if(request('dni') && !$userBuscado)
            <div class="alert alert-warning mt-3 mb-0">No se encontró ningún competidor con ese DNI.</div>
        @endif

        @if($userBuscado)
            <div class="alert alert-light border mt-3 d-flex justify-content-between align-items-center mb-0">
                <div>
                    <strong>{{ $userBuscado->name }}</strong>
                    <span class="text-muted small ms-2">{{ $userBuscado->dni }} · {{ $userBuscado->provincia }}</span>
                </div>
                <form method="POST" action="{{ route('entrenador.solicitar') }}">
                    @csrf
                    <input type="hidden" name="competidor_id" value="{{ $userBuscado->id }}">
                    <button class="btn btn-sm btn-success">Enviar solicitud</button>
                </form>
            </div>
        @endif
    </div>
</div>

{{-- Inscribir en competición --}}
@if($competiciones->isNotEmpty())
<div class="card mb-4">
    <div class="card-header fw-semibold">Inscribir en competición</div>
    <div class="card-body">
        <form method="POST" action="{{ route('entrenador.inscribir') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Competición</label>
                <select name="competicion_id" class="form-select" required>
                    <option value="" disabled selected>Selecciona una competición...</option>
                    @foreach($competiciones as $c)
                        <option value="{{ $c->id }}">
                            {{ $c->name }} — {{ $c->fecha_realizacion?->format('d/m/Y') ?? 'Sin fecha' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Participantes</label>
                <div class="border rounded p-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               name="participantes[]" value="{{ auth()->id() }}" id="self">
                        <label class="form-check-label" for="self">
                            <strong>Yo mismo</strong>
                            <span class="badge bg-warning text-dark ms-1">Árbitro</span>
                        </label>
                    </div>
                    @foreach($competidores as $comp)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   name="participantes[]" value="{{ $comp->id }}" id="comp-{{ $comp->id }}">
                            <label class="form-check-label" for="comp-{{ $comp->id }}">
                                {{ $comp->name }} <span class="text-muted small">({{ $comp->dni }})</span>
                            </label>
                        </div>
                    @endforeach
                    @if($competidores->isEmpty())
                        <p class="text-muted small mb-0 mt-1">No tienes competidores en tu equipo.</p>
                    @endif
                </div>
            </div>
            <button class="btn btn-primary">Inscribir seleccionados</button>
        </form>
    </div>
</div>
@endif

</div>
</div>
@endsection
