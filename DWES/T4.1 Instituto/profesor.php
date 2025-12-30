<?php
require_once('clases.php');

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['asignar']))
    {


    $nombreAlumno = $_POST['nombreAlumno'];
    $asignatura = $_POST['asignatura'];
    $nota = $_POST['nota'];

    // Cargamos los usuarios y asignamos la nota al alumno correspondiente
    $usuarios = unserialize(file_get_contents('usuarios.txt'));
    foreach ($usuarios as $usuario) {
        if ($usuario instanceof Alumno && $usuario->getNombre() == $nombreAlumno) {
            $usuario->asignarNota($asignatura, $nota);
            break;
        }
    }

    // Guardamos los cambios
    file_put_contents('usuarios.txt', serialize($usuarios));
    echo "Nota asignada correctamente.";

    }


    if(isset($_POST['cerrar']))
    {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Profesor</title>
</head>
<body>
    <h2>Asignar Notas</h2>
    <form action="profesor.php" method="POST">
        <label for="nombreAlumno">Nombre del alumno:</label>
        <input type="text" name="nombreAlumno" required><br>
        <label for="asignatura">Asignatura:</label>
        <input type="text" name="asignatura" required><br>
        <label for="nota">Nota:</label>
        <input type="number" name="nota" min="0" max="10" required><br>
        <button type="submit"name="asignar">Asignar nota</button>
    </form>

    <form action="profesor.php" method="POST">
        <button type="submit" name="cerrar" >Cerrar</button>
    </form>
</body>
</html>
