<?php

if (isset($_COOKIE['nombre'])){

    $nombre = $_COOKIE['nombre'];
    setcookie('nombre', $nombre, time()+5);
}else{
    header("location: p1.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
     <link rel="stylesheet" href="style.css">
</head>
    <body>

    <h2>Bienvenido</h2>
    <br>

    <?php

    if(!empty($nombre)){

        echo "Hola " . $nombre;
    }

    ?>

    </body>
</html>