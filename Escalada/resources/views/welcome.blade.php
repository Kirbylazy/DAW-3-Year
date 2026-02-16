<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">

            <div class="card shadow-sm">
                <div class="card-body p-4 text-center">
                    <h2 class="mb-2">Bienvenido</h2>
                    <p class="text-muted mb-4">Elige una opción para continuar</p>

                    <div class="d-grid gap-3">
                        {{-- Opción 1: registro (Breeze la crea) --}}
                        <a class="btn btn-primary btn-lg" href="{{ route('register') }}">
                            Registrar nuevo usuario
                        </a>

                        {{-- Opción 2: perfil (si no está logueado, ir a login) --}}
                        @auth
                            <a class="btn btn-outline-secondary btn-lg" href="{{ route('profile.edit') }}">
                                Acceder a mi perfil
                            </a>
                        @else
                            <a class="btn btn-outline-secondary btn-lg" href="{{ route('login') }}">
                                Acceder a mi perfil
                            </a>
                        @endauth
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
