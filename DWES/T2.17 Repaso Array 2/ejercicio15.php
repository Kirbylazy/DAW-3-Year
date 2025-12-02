<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 15 - N productos mas baratos</title>
</head>
<body>
    <h1>Ejercicio 15: N productos mas baratos</h1>

    <form method="POST">
        <label for="categoria">Categoria:</label>
        <select name="categoria" id="categoria" required>
            <option value="">-- Selecciona una categoria --</option>
            <!-- TODO: Generar opciones dinamicamente con obtenerCategorias() -->
        </select>
        <br><br>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" min="1" max="10" value="2" required>
        <br><br>
        <button type="submit" name="submit">Ejecutar</button>
    </form>

    <!-- TODO: Mostrar resultado cuando se envie el formulario -->
    <!-- Debe mostrar tabla con los N productos mas baratos (solo precios) -->
    <!-- Debe mostrar tabla completa con todos los productos ordenados por precio -->
</body>
</html>
