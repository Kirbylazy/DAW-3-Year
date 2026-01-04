<?php
require_once('funciones.php');
session_start();

if (isset($_POST['volver'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['registrar'])) {
    $resultado = registrar(
        $_POST['nombre'],
        $_POST['email'],
        $_POST['clave'],
        $_POST['clave2']
    );

    if ($resultado['ok']) {
        header("Location: login.php");
        exit;
    } else {
        $error = $resultado['error'];
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Recetario</title>
</head>

<body>
    <h1>Recetario</h1>
    <h2>Registro</h2>
    <form action="" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required placeholder="Nombre"><br>
        <label for="email">Email:</label>
        <input type="text" name="email" required placeholder="Email"><br>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave" required placeholder="Contraseña"><br>
        <label for="clave">Confirmar contraseña:</label>
        <input type="password" name="clave2" required placeholder="Repetir contraseña"><br>
        <button type="submit" name="registrar">Registrar</button>
        <button type="submit" name="volver">Volver</button>
    </form>
    
    <!-- Aquí informa del mensaje -->
    <?php if (isset($error)): ?>
    <p style="color:red"><?= $error ?></p>
    <?php endif; ?>


</body>

</html>