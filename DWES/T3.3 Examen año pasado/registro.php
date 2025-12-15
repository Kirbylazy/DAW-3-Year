

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form action="registro.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" ><br>
        <label for="tipo">Tipo:</label>
        <select name="tipo">
            <option value="profesor">Profesor</option>
            <option value="alumno">Alumno</option>
        </select><br>
        <button type="submit" name="registrar">Registrar</button>
    </form>
</body>
</html>
