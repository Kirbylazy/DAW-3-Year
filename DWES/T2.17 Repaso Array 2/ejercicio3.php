<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 3 - Verificar si cliente compro producto</title>
</head>
<body>
    <h1>Ejercicio 3: Verificar si cliente compro producto</h1>

    <form method="POST">
        <label for="idCliente">ID Cliente:</label>
        <select name="idCliente" id="idCliente" required>
            <option value="">-- Selecciona un cliente --</option>
            <!-- TODO: Generar opciones dinamicamente con obtenerIdsClientesAux() -->
        </select>
        <br><br>
        <label for="idProducto">ID Producto:</label>
        <input type="text" name="idProducto" id="idProducto" placeholder="Ej: P001, M001, T001" required>
        <br><br>
        <button type="submit" name="submit">Ejecutar</button>
    </form>

    <!-- TODO: Mostrar resultado cuando se envie el formulario -->
    <!-- Debe mostrar si el cliente SI o NO compro el producto -->
    <!-- Debe mostrar tabla con todas las compras del cliente -->
</body>
</html>
