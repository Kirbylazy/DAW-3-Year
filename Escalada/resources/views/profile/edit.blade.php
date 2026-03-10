@extends('layouts.app')
@section('title', 'Mi perfil')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">

        <h3 class="mb-4">Mi perfil</h3>

        {{-- Datos personales --}}
        <div class="card mb-4">
            <div class="card-header fw-semibold">Datos personales</div>
            <div class="card-body">

                @if(session('status') === 'profile-updated')
                    <div class="alert alert-success">Perfil actualizado correctamente.</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf @method('PATCH')
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nombre completo</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">DNI</label>
                            <input type="text" name="dni" class="form-control"
                                   value="{{ old('dni', $user->dni) }}" placeholder="12345678A">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Fecha de nacimiento</label>
                            <input type="date" name="fecha_nacimiento" class="form-control"
                                   value="{{ old('fecha_nacimiento', $user->fecha_nacimiento?->format('Y-m-d')) }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Provincia</label>
                            <select name="provincia" class="form-select">
                                <option value="">—</option>
                                @foreach(['Almería','Cádiz','Córdoba','Granada','Huelva','Jaén','Málaga','Sevilla','Madrid','Barcelona','Valencia','Otros'] as $prov)
                                    <option value="{{ $prov }}" @selected(old('provincia', $user->provincia) === $prov)>{{ $prov }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Talla</label>
                            <select name="talla" class="form-select">
                                <option value="">—</option>
                                @foreach(['XS','S','M','L','XL','XXL'] as $t)
                                    <option value="{{ $t }}" @selected(old('talla', $user->talla) === $t)>{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Género</label>
                            <select name="genero" class="form-select">
                                <option value="">—</option>
                                <option value="M"    @selected(old('genero', $user->genero) === 'M')>Masculino</option>
                                <option value="F"    @selected(old('genero', $user->genero) === 'F')>Femenino</option>
                                <option value="otro" @selected(old('genero', $user->genero) === 'otro')>Otro</option>
                            </select>
                        </div>

                        <div class="col-md-4 d-flex align-items-end">
                            <div class="w-100">
                                <label class="form-label fw-semibold">Rol</label>
                                <input type="text" class="form-control" value="{{ $user->rol }}" disabled>
                            </div>
                        </div>

                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Cambiar contraseña --}}
        <div class="card mb-4">
            <div class="card-header fw-semibold">Cambiar contraseña</div>
            <div class="card-body">

                @if(session('status') === 'password-updated')
                    <div class="alert alert-success">Contraseña actualizada.</div>
                @endif
                @if($errors->updatePassword->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">@foreach($errors->updatePassword->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Contraseña actual</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Nueva contraseña</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Confirmar contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-outline-primary">Actualizar contraseña</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Eliminar cuenta --}}
        <div class="card border-danger">
            <div class="card-header fw-semibold text-danger">Zona de peligro</div>
            <div class="card-body">
                <p class="text-muted small">Una vez eliminada, tu cuenta no se podrá recuperar.</p>
                <button type="button" class="btn btn-outline-danger btn-sm"
                        data-bs-toggle="modal" data-bs-target="#modalEliminarCuenta">
                    Eliminar mi cuenta
                </button>
            </div>
        </div>

    </div>
</div>

{{-- Modal eliminar cuenta --}}
<div class="modal fade" id="modalEliminarCuenta" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Eliminar cuenta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf @method('DELETE')
                <div class="modal-body">
                    <p>Introduce tu contraseña para confirmar la eliminación de tu cuenta.</p>
                    @if($errors->userDeletion->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">@foreach($errors->userDeletion->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar cuenta</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
