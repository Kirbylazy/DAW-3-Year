<?php
require_once('clases.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    /**
     *  BOTÓN INICIAR
     */
    if(isset($_POST['iniciar']))
    {
        $nombre = $_POST['nombre'];

        if (file_exists('usuarios.txt'))
        {
        $fichero = file_get_contents('usuarios.txt');
        $usuarios = unserialize($fichero);

        if (!empty($usuarios))
        {
        foreach ($usuarios as $usuario) {
            if ($usuario->getNombre() == $nombre) {

                $_SESSION['usuario'] = $usuario;

                if($_SESSION['usuario']->getTipo() == 'alumno')
                {
                    header('Location: alumno.php');
                }
                else
                {
                    header('Location: profesor.php');
                }
                exit;
            }
        }
        echo 'Usuario o contraseña incorrectos.';
    }
    else
    {
        echo 'El usuario no existe.';
    }
    }else
    {
        echo 'El usuario no existe.';
    }
    }

    /**
     *  BOTÓN REGISTRO
     */
    if(isset($_POST['registro']))
    {

        // Establecer cookie de duración
        setcookie("registro", time(), time() + 5);
        header('Location: registro.php');
        exit();
    }

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="index.php" method="POST">
        <label for="email">Email:</label>
        <input type="text" name="email" ><br>
        <label for="clave">Contraseña:</label>
        <input type="text" name="clave" ><br>
        <button type="submit" name="iniciar">Iniciar sesión</button>
        <button type="submit" name="registro" >Registro</button>
    </form>
</body>
</html>
