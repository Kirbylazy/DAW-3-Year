<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 8 - Salario minimo de un departamento</title>
</head>
<body>
    <h1>Ejercicio 8: Salario minimo de un departamento</h1>

    <form method="POST">
        <label for="departamento">Departamento:</label>
        <select name="departamento" id="departamento" required>
            <option value="">-- Selecciona un departamento --</option>
            <!-- TODO: Generar opciones dinamicamente con obtenerDepartamentos() -->
        </select>
        <button type="submit" name="submit">Ejecutar</button>
    </form>

    <!-- TODO: Mostrar resultado cuando se envie el formulario -->
    <!-- Debe mostrar el salario minimo del departamento -->
    <!-- Debe mostrar tabla con todos los empleados del departamento -->
    <!-- Columnas: ID Empleado, Nombre, Salario -->
</body>
</html>
