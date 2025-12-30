<?php
require_once 'funciones.php';

// Obtener la cita más valorada


$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Botón de registro
    if (isset($_POST['ir_registro'])) {

    }

    // Botón de login
    if (isset($_POST['login'])) {

    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Citas Célebres - Login</title>
</head>

<body>
    <h1 class="titulo">Citas Célebres</h1>

//Mostrar cita destacada

    <form method="POST">
        <h2>Iniciar Sesión</h2>

        <input type="email" name="email" placeholder="Correo"><br>
        <input type="password" name="clave" placeholder="Contraseña"><br>

        <button type="submit" name="login">Iniciar Sesión</button>
        <button type="submit" name="ir_registro">Registrarse</button>
    </form>


        // Muestro mensaje 

</body>

</html>