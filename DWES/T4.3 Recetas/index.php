<?php
require_once('funciones.php');
session_start();

if (isset($_POST['login'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['registrar'])) {
    header("Location: registro.php");
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
    <!-- MOSTRAR LA RECETA QUE MAS VECES SEA FAVORITA -->
     <h2>Lista de favoritas</h2>
     <?php $favoritos = recetafavorita(); ?>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Tiempo</th>
        <th>Descripción</th>
        <th>Favoritos</th>
    </tr>

    <?php foreach ($favoritos as $f): ?>
    <tr>
        <td><?= $f['id'] ?></td>
        <td><?= $f['titulo'] ?></td>
        <td><?= $f['descripcion'] ?></td>
        <td><?= $f['total_favoritos'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<br><br>

    <form action="" method="POST">
        <!-- Botones para logearse y registrarse -->
        <button type="submit" name="login" >Log in</button>
        <button type="submit" name="registrar" >Registrarse</button>
    </form>
</body>

</html>