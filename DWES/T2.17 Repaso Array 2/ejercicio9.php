<!-- ### Ejercicio 9: Productos no comprados por cliente
**Función PHP:** `array_diff`
**Función a implementar:** `obtenerProductosNoComprados(array $productos, array $clientes, string $idCliente): array`

**Frontend:**
- Formulario con select de clientes (generado dinámicamente)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Tabla con productos NO comprados por el cliente
- Total de productos sin comprar -->

<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 9 - Productos no comprados por cliente</title>
</head>
<body>
    <h1>Ejercicio 9: Productos no comprados por cliente</h1>

    <form method="POST">
        <label for="idCliente">ID Cliente:</label>
        <select name="idCliente" id="idCliente" required>
            <option value="">-- Selecciona un cliente --</option>
            <!-- TODO: Generar opciones dinamicamente con obtenerIdsClientesAux() -->
        </select>
        <button type="submit" name="submit">Ejecutar</button>
    </form>

    <!-- TODO: Mostrar resultado cuando se envie el formulario -->
    <!-- Debe mostrar tabla con productos NO comprados por el cliente -->
    <!-- Debe mostrar el total de productos sin comprar -->
</body>
</html>
