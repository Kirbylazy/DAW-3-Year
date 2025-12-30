<?php
require_once 'funciones.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Botón de volver al login
    if (isset($_POST['ir_login'])) {

    }

    // Botón de registro
    if (isset($_POST['registro'])) {
       
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro - Citas Célebres</title>
</head>

<body>
    <form method="POST">
        <h2>Registro</h2>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre"?><br>
        <label for="email">Correo:</label>
        <input type="email" name="email"?><br>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave"><br>
        <label for="confirmar_clave">Confirmar contraseña:</label>
        <input type="password" name="confirmar_clave"><br>

        <button type="submit" name="registro">Registrarse</button>
        <button type="submit" name="ir_login">Volver a Login</button>
    </form>

    //MOSTRAR MENSAJES

</body>

</html>