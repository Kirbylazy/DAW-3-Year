<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 19 - Productos exclusivos por tipo proveedor</title>
</head>
<body>
    <h1>Ejercicio 19: Productos exclusivos por tipo proveedor</h1>

    <form method="POST">
        <label for="tipo1">Tipo de proveedor 1:</label>
        <select name="tipo1" id="tipo1" required>
            <option value="">-- Selecciona tipo 1 --</option>
            <option value="nacional">nacional</option>
            <option value="internacional">internacional</option>
        </select>
        <br><br>
        <label for="tipo2">Tipo de proveedor 2:</label>
        <select name="tipo2" id="tipo2" required>
            <option value="">-- Selecciona tipo 2 --</option>
            <option value="nacional">nacional</option>
            <option value="internacional">internacional</option>
        </select>
        <br><br>
        <button type="submit" name="submit">Ejecutar</button>
    </form>

    <!-- TODO: Mostrar resultado cuando se envie el formulario -->
    <!-- Debe mostrar tabla con productos exclusivos del tipo1 -->
    <!-- Productos que suministran proveedores tipo1 pero NO tipo2 -->
</body>
</html>
