<?php
require_once('clases.php');

if(!isset($_COOKIE['registro']))
{
    header('Location: index.php');
    exit();
}

setcookie("registro", time(), time() + 5);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registrar'])) {
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];

    // Dependiendo del tipo creamos el objeto correspondiente
    if ($tipo == 'alumno') {
        $usuario = new Alumno($nombre);
    } else {
        $usuario = new Profesor($nombre);
    }

    // Guardamos el usuario en el archivo
    if(file_exists('usuarios.txt'))
    {
        unserialize(file_get_contents('usuarios.txt'));
    }
    else
    {
        $usuarios = array();
    }

    $usuarios[] = $usuario;
    file_put_contents('usuarios.txt', serialize($usuarios));

    $puntero = fopen('usuarios.txt', 'a');
    
    echo '¡Registro exitoso!';

    header('Location: index.php');
    exit();

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form action="registro.php" method="POST">
        <label for="dni">DNI:</label>
        <input type="text" name="dni"><br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre"><br>
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono"><br>
        <label for="email">email:</label>
        <input type="text" name="email"><br>
        <label for="ciudad">Ciudad:</label>
        <input type="text" name="ciudad"><br>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave"><br>
        <label for="tipo">Tipo:</label>
        <select name="tipo">
            <option value="profesor">Profesor</option>
            <option value="alumno">Alumno</option>
        </select><br>
        <button type="submit" name="registrar">Registrar</button>
    </form>
</body>
</html>
