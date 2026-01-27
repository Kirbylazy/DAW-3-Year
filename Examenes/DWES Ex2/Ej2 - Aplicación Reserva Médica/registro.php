<?php
session_start();
include_once('funciones.php');

// Si hay una sesión activa, redirigir a principal
if (isset($_SESSION['id'])) {
    header('Location: principal.php');
    exit;
}

// Mensaje (flash)
$mensaje = '';
if (isset($_SESSION['mensaje']) && $_SESSION['mensaje'] !== '') {
    $mensaje = (string)$_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
}

// COMPORTAMIENTO DE BOTONES
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // BOTÓN DE VOLVER A PAGINA PRINCIPAL
    if (isset($_POST['volver'])) {
        header('Location: index.php');
        exit;
    }

    // BOTÓN DE REGISTRO
    if (isset($_POST['registrar'])) {

        $nombre = trim($_POST['nombre'] ?? '');
        $email  = trim($_POST['email'] ?? '');
        $clave  = $_POST['clave'] ?? '';
        $clave_confirm = $_POST['clave_confirm'] ?? '';

        // Validación básica
        if ($nombre === '' || $email === '' || $clave === '' || $clave_confirm === '') {
            $_SESSION['mensaje'] = 'Todos los campos son obligatorios.';
            header('Location: registro.php');
            exit;
        }

        if ($clave !== $clave_confirm) {
            $_SESSION['mensaje'] = 'Las claves no coinciden.';
            header('Location: registro.php');
            exit;
        }

        // Registrar
        if (registrarPaciente($nombre, $email, $clave)) {
            $_SESSION['mensaje'] = 'Registro completado. Ya puedes iniciar sesión.';
            header('Location: index.php');
            exit;
        }

        // Email ya existente (u otro fallo)
        $_SESSION['mensaje'] = 'No se pudo registrar. Es posible que el email ya esté registrado.';
        header('Location: registro.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Pacientes - Sistema de Gestión de Citas Médicas</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <table>
        <tr>
            <th>Registro de Pacientes - Sistema de Gestión de Citas Médicas</th>
        </tr>
    </table>

    <!-- MENSAJES INFORMATIVOS -->
    <?php if ($mensaje !== ''): ?>
        <table class="mensaje">
            <tr>
                <td><?= htmlspecialchars($mensaje) ?></td>
            </tr>
        </table>
    <?php endif; ?>

    <form method="post" action="">
        <table>
            <tr>
                <th colspan="2">Registro de Nuevo Paciente</th>
            </tr>
            <tr>
                <td><label for="nombre">Nombre completo:</label></td>
                <td><input type="text" id="nombre" name="nombre" required value=""></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="email" required value=""></td>
            </tr>
            <tr>
                <td><label for="clave">Clave:</label></td>
                <td><input type="password" id="clave" name="clave" required></td>
            </tr>
            <tr>
                <td><label for="clave_confirm">Confirmar clave:</label></td>
                <td><input type="password" id="clave_confirm" name="clave_confirm" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="registrar" value="Registrar">
                    <input type="submit" name="volver" value="Volver" formnovalidate>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
