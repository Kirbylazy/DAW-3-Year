<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Escalada')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Escalada</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                {{-- Añade aquí tus secciones reales --}}
                @php use Illuminate\Support\Facades\Route; @endphp

                @if (Route::has('competiciones.index'))
                    <a class="nav-link" href="{{ route('competiciones.index') }}">Competiciones</a>
                @endif

                @if (Route::has('copas.index'))
                    <a class="nav-link" href="{{ route('copas.index') }}">Copas</a>
                @endif

                @if (Route::has('ubicaciones.index'))
                    <a class="nav-link" href="{{ route('ubicaciones.index') }}">Ubicaciones</a>
                @endif
            </ul>

            <div class="d-flex align-items-center gap-3">
                <span class="text-white-50 small">
                    @auth
                        {{ auth()->user()->name }}
                        <span class="badge bg-secondary ms-1">{{ auth()->user()->rol }}</span>
                    @else
                        Invitado
                    @endauth
                </span>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a class="btn btn-outline-warning btn-sm" href="{{ route('admin.usuarios') }}">
                            Admin
                        </a>
                    @endif

                    <a class="btn btn-outline-light btn-sm" href="{{ route('profile.edit') }}">
                        Perfil
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button class="btn btn-warning btn-sm" type="submit">
                            Salir
                        </button>
                    </form>
                @else
                    <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<main class="container py-4">

    {{-- Mensajes flash opcionales --}}
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Contenido --}}
    {{ $slot ?? '' }}

    {{-- Si en alguna vista usas @section('content') con extends, también lo soporta --}}
    @yield('content')

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
