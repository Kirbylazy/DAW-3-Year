<?php

session_start();

if (isset($_SESSION['nombre'])){

    $nombre = $_SESSION['nombre'];

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
    
    <br>
    <br>
        <!-- Creamos un formulario para recoger todos los datos -->
    
        <form method="post" action="">
    
            <button type="submit" name="confirmar">Salir</button>
            <p><br></p>
    
        </form>

        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
            // Una vez pulsado el botón podemos empezar a operar
    
            if (isset($_POST['confirmar'])) {

                session_unset();
                session_destroy();
                header("location: p1.php");

            }
        }

            ?>

    

    </body>
</html>