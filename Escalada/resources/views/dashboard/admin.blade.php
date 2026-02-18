@extends('layouts.app')

@section('title', 'Dashboard — Admin')

@section('content')
<h3 class="mb-4">Panel de administración</h3>

@if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Gestión de usuarios</span>
        <a href="{{ route('admin.usuarios') }}" class="btn btn-sm btn-outline-primary">Ver todos</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol actual</th>
                    <th>Cambiar rol</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $u)
                    <tr>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>
                            <span class="badge
                                {{ $u->rol === 'arbitro' ? 'bg-warning text-dark' : 'bg-secondary' }}">
                                {{ $u->rol }}
                            </span>
                        </td>
                        <td>
                            <form method="POST"
                                  action="{{ route('admin.usuarios.rol', $u->id) }}"
                                  class="d-flex gap-2 align-items-center">
                                @csrf
                                @method('PATCH')
                                <select name="rol" class="form-select form-select-sm" style="width:auto">
                                    <option value="competidor" @selected($u->rol === 'competidor')>Competidor</option>
                                    <option value="arbitro"    @selected($u->rol === 'arbitro')>Árbitro</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">No hay usuarios.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($usuarios->hasPages())
        <div class="card-footer">
            {{ $usuarios->links() }}
        </div>
    @endif
</div>

<h5 class="mb-3">Próximas competiciones</h5>

@if($competiciones->count() === 0)
    <div class="alert alert-secondary">No hay competiciones futuras ahora mismo.</div>
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
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-4">{{ $competiciones->links() }}</div>
@endif
@endsection
