<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1 - Contar productos por categoria</title>
</head>
<body>
    <h1>Ejercicio 1: Contar productos por categoria</h1>

    <form method="POST">
        <label for="categoria">Categoria:</label>
        <select name="categoria" id="categoria" required>
            <option value="">-- Selecciona una categoria --</option>
            <!-- TODO: Generar opciones dinamicamente con obtenerCategorias() -->
        </select>
        <button type="submit" name="submit">Ejecutar</button>
    </form>

    <!-- TODO: Mostrar resultado cuando se envie el formulario -->
    <!-- Debe mostrar tabla con todos los productos de la categoria seleccionada -->
    <!-- Columnas: ID, Nombre, Precio, Stock, Valoracion -->
    <!-- Al final mostrar el total de productos -->
</body>
</html>
