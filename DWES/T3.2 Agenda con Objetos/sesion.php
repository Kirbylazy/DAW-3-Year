<?php

require_once('persona.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['guardar'])) {
        if (isset($_POST['no']) && isset($_POST['nu']))
        $no = $_POST["no"];
        $nu = $_POST["nu"];
        $_SESSION['agenda'][] = new persona($no,$nu);
    }

    if (isset($_POST['logout'])) {
        session_unset();      
        session_destroy();    
        header("Location: ".$_SERVER['PHP_SELF']); // Recarga la página para volver al login
        exit();
    }

    if (isset($_POST['exp'])){
        file_put_contents('fichero.txt',serialize($_SESSION['agenda']));
    }

    if (isset($_POST['imp'])){
        $fichero = file_get_contents('fichero.txt');
        $_SESSION['agenda'] = unserialize($fichero);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido <?= $_SESSION['nombre'] ?></title>
</head>
<body>

    <?php if (isset ($_SESSION['agenda'])): ?>

    <h2>Introduce tu nombre</h2>

    <form method="post">
        <label for="no">Nombre:</label>
        <input type="text" name="no" id="no">
        <label for="nu">Numero:</label>
        <input type="number" name="nu" id="nu">
        <button type="submit" name="guardar">Guardar</button>
        <button type="submit" name="mostrar">Mostrar</button>
        <button type="submit" name="exp">Exportar</button>
        <button type="submit" name="imp">Importar</button>
    </form>

   <?php 
   if ($_SERVER["REQUEST_METHOD"] == "POST"):

    // MOSTRAR AGENDA
    if (isset($_POST['mostrar'])):?>

    <h3>Agenda guardada:</h3>
    <?php foreach ($_SESSION['agenda'] as $nombre): ?>
        <p><?= $nombre->getNombre() ?> <?= $nombre->getNumero() ?></p>
    <?php endforeach; ?>

    <?php endif; endif; ?>

    <!-- BOTÓN LOGOUT -->
    <form method="post">
        <button type="submit" name="logout">
            Logout
        </button>
    </form>

    <?php else:
            header('location: login.php');
    endif;?>

</body>
</html>