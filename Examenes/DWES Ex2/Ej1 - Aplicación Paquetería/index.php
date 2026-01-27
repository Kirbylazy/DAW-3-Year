<?php
// Si existe la cookie de id_cliente, la eliminamos para "cerrar sesión"
if(isset($_COOKIE['id'])){

    setcookie('id', $_COOKIE['id'], time()-3600);
}

// Guardar ID en cookie (30 segundos de duración)

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['id_cliente'])){

        setcookie('id', $_POST['id_cliente'], time() +30);
        header('Location: principal.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestión de Paquetería</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        /* Estilos específicos para la página de inicio */
        .container {
            max-width: 500px;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sistema de Gestión de Paquetería</h1>
        <p>Ingresa tu ID de cliente para acceder al sistema.</p>
        <form method="post">
            <div class="form-row">
                <label for="id_cliente">ID de Cliente:</label>
                <input type="text" id="id_cliente" name="id_cliente" required>
            </div>
            <div class="form-row" style="text-align: center;">
                <input type="submit" name='entrar' value="Entrar">
            </div>
        </form>
    </div>
</body>
</html>