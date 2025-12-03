<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agenda</title>
     <!-- <link rel="stylesheet" href="style.css"> -->
</head>
    <body>

    <h2>Introduce tu nombre</h2>
    
        <!-- Creamos un formulario para recoger todos los datos -->
    
        <form method="post" action="">
    
            <!-- Pedimos el primer numero -->
    
            <label for="n1">Nombre:</label>
            <input type="text" name="n" id="n" required>
    
            <button type="submit" name="guardar">Guardar</button>
            <button type="submit" name="mostrar">Mostrar</button>
            <p><br></p>
    
        </form>
    
        <?php

        session_start();

        $agenda = [];
    
        // Recogemos todos los datos desde el post
    
        if ($_SERVER["REQUEST_METHOD"] == "POST"):
    
            // Asignamos a cada variable su valor
    
            $n = $_POST["n"];
    
            // Una vez pulsado el botón podemos empezar a operar
    
            if (isset($_POST['guardar'])) {

                if (isset($_SESSION['agenda'])){
                    
                    $agenda = $_SESSION['agenda'];
                    $agenda [] = $n;
                    $_SESSION['agenda'] = $agenda;

                }else{
                    $agenda [] = $n;
                    $_SESSION['agenda'] = $agenda;
                }
                

            }

            if (isset($_POST['mostrar'])):

                if (isset($_COOKIE['agenda'])):

                    $agenda = $_SESSION['agenda'];

                    foreach ($agenda as $nombre): ?>
                        <p><?= $nombre ?></p>
                    <?php endforeach; ?>

                <?php endif; ?>

            <?php endif; ?>

        <?php endif ?>

    </body>
</html>