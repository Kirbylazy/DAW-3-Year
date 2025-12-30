<?php
require_once 'funciones.php';
requerir_login();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Botón de volver
    if (isset($_POST['volver'])) {

    }

    // Botón de guardar cita
    if (isset($_POST['guardar'])) {

    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nueva Cita</title>
</head>

<body>
    <form method="POST">
        <h2>Nueva Cita</h2>

        <label for="texto">Texto:</label><br>
        <textarea
            name="texto"
            placeholder="Texto de la cita"
            rows="4"
            required value="">
        </textarea><br>

        <label for="autor">Autor:</label><br>
        <input
            type="text"
            name="autor"
            placeholder="Autor"
            required
            value=""><br><br>

        <button type="submit" name="guardar">Guardar Cita</button>
        <button type="submit" name="volver">Volver</button>
    </form>

</body>

</html>