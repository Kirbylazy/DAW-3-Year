<?php
require_once('funciones.php');
session_start();

if (isset($_POST['volver'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['iniciar'])) {
    login($_POST['email'], $_POST['clave']);
    exit();
}

if ($_SESSION['nombre'] != null){
    header('Location: principal.php');
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Recetario</title>
</head>

<body>
    <h1>Recetario</h1>
    <h2>Login</h2>
    <form action="" method="POST">
        <label for="email">Email:</label>
        <input type="text" name="email"><br>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave"><br>
        <button type="submit" name="iniciar">Iniciar sesión</button>
        <button type="submit" name="volver">Volver</button>
    </form>
    <!-- Mensaje -->

</body>

</html>