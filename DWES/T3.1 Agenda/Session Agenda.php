<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['login'])) {
        $_SESSION['agenda'] = []; 
    }

    if (isset($_POST['guardar'])) {
        $n = $_POST["n"];
        $_SESSION['agenda'][] = $n;
    }

    if (isset($_POST['logout'])) {
        session_unset();      
        session_destroy();    
        header("Location: ".$_SERVER['PHP_SELF']); // Recarga la página para volver al login
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agenda</title>
</head>
<body>

<?php if (!isset($_SESSION['agenda'])): ?>

    <!-- FORMULARIO LOGIN -->
    <h2>Iniciar sesión</h2>
    <form method="post">
        <button type="submit" name="login">Login</button>
    </form>

<?php else: ?>

    <h2>Introduce tu nombre</h2>

    <form method="post">
        <label for="n">Nombre:</label>
        <input type="text" name="n" id="n" required>
        <button type="submit" name="guardar">Guardar</button>
        <button type="submit" name="mostrar">Mostrar</button>
    </form>

   <?php 
   if ($_SERVER["REQUEST_METHOD"] == "POST"):

    // MOSTRAR AGENDA
    if (isset($_POST['mostrar'])):?>

    <h3>Agenda guardada:</h3>
    <?php foreach ($_SESSION['agenda'] as $nombre): ?>
        <p><?= $nombre ?></p>
    <?php endforeach; ?>

    <?php endif; endif; ?>

    <!-- BOTÓN LOGOUT -->
    <form method="post">
        <button type="submit" name="logout">
            Logout
        </button>
    </form>

<?php endif; ?>

</body>
</html>