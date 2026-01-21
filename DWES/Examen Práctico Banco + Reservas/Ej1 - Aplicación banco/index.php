<?php

 if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['dni'])){

        setcookie('usuario', $_POST['dni'], time()+30, "/");

        // Redirigir inmediatamente
        header('Location: principal.php');
        exit;
    }
}

// Si ya tenía cookie de antes
if(isset($_COOKIE['usuario'])){
    header('Location: principal.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Banco</title>
</head>
<body>
    <h1>Bienvenido a Mi Banco</h1>
    <p>Ingresa tus datos para acceder a tu cuenta bancaria.</p>
    <form method="post">
        <label for="dni">Ingresa tu DNI:</label>
        <input type="text" id="dni" name="dni" required>
        <br><br>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>