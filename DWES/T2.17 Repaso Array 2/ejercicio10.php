<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 10 - Reindexar idiomas de cliente</title>
</head>
<body>
    <h1>Ejercicio 10: Reindexar idiomas de cliente</h1>

    <form method="POST">
        <label for="idCliente">ID Cliente:</label>
        <select name="idCliente" id="idCliente" required>
            <option value="">-- Selecciona un cliente --</option>
            <!-- TODO: Generar opciones dinamicamente con obtenerIdsClientesAux() -->
        </select>
        <button type="submit" name="submit">Ejecutar</button>
    </form>

    <!-- TODO: Mostrar resultado cuando se envie el formulario -->
    <!-- Debe mostrar tabla de niveles reindexados desde 0 -->
    <!-- Columnas: Indice, Nivel -->
</body>
</html>
