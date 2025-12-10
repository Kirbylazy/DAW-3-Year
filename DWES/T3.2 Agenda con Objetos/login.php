<?php
//Dario Aguilar Rodriguez
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['login'])) {
        if (isset($_POST['nombre']))
            $_SESSION['nombre'] = $_POST['n'];
            $_SESSION['agenda'] = []; 
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
        <label for="n">Nombre:</label>
        <input type="text" name="n" id="n" required>
        <button type="submit" name="login">Login</button>
    </form>

    <?php else: 
            header('location: sesion.php');
    endif;?>
</body>
</html>