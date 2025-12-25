<!-- ### Ejercicio 13: Empleado mejor pagado
**Funciones PHP:** `max` + `foreach`
**Función a implementar:** `obtenerEmpleadoMejorPagado(array $empleados, string $departamento): string`

**Frontend:**
- Formulario con select de departamentos (generado dinámicamente)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Nombre del empleado mejor pagado
- Tabla con todos los empleados del departamento -->

<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 13 - Empleado mejor pagado</title>
</head>
<body>
    <h1>Ejercicio 13: Empleado mejor pagado</h1>

    <form method="POST">
        <label for="departamento">Departamento:</label>
        <select name="departamento" id="departamento" required>
            <option value="">-- Selecciona un departamento --</option>
            <!-- TODO: Generar opciones dinamicamente con obtenerDepartamentos() -->
        </select>
        <button type="submit" name="submit">Ejecutar</button>
    </form>

    <!-- TODO: Mostrar resultado cuando se envie el formulario -->
    <!-- Debe mostrar el nombre del empleado mejor pagado -->
    <!-- Debe mostrar tabla con todos los empleados del departamento -->
</body>
</html>
