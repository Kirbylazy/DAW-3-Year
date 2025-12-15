

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Profesor</title>
</head>
<body>
    <h2>Asignar Notas</h2>
    <form action="" method="POST">
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
