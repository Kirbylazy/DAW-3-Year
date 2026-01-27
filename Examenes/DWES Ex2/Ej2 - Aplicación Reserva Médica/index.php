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
    unset($_SESSION['mensaje']); // mostrar una vez
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['login'])) {
        $email = $_POST['email'] ?? '';
        $clave = $_POST['clave'] ?? '';

        // Solo si el login es correcto se entra al panel
        if (iniciarSesion($email, $clave)) {
            header('Location: principal.php');
            exit;
        }

        // Si falla, iniciarsesion ya habrá puesto mensaje en $_SESSION['mensaje']
        header('Location: index.php');
        exit;
    }

    if (isset($_POST['registro'])) {
        header('Location: registro.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestión de Citas Médicas</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <table>
        <tr>
            <th colspan="2">Sistema de Gestión de Citas Médicas</th>
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

    <form method="POST" action="">
        <table>
            <tr>
                <th colspan="2">Iniciar Sesión</th>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="email" required></td>
            </tr>
            <tr>
                <td><label for="clave">Clave:</label></td>
                <td><input type="password" id="clave" name="clave" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="login" value="Iniciar Sesión">
                    <input type="submit" name="registro" value="Registrarse" formnovalidate>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
