<!-- ### Ejercicio 14: Productos sin vender
**Funciones PHP:** `array_diff` + `count`
**Función a implementar:** `contarProductosSinVender(array $productos, array $clientes): int`

**Frontend:**
- Formulario con solo botón "Ejecutar"

**Resultado a mostrar:**
- Cantidad de productos sin vender
- Tabla con los productos que no han sido comprados -->

<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 14 - Productos sin vender</title>
</head>
<body>
    <h1>Ejercicio 14: Productos sin vender</h1>

    <form method="POST">
        <button type="submit" name="submit">Ejecutar</button>
    </form>

    <!-- TODO: Mostrar resultado cuando se envie el formulario -->
    <!-- Debe mostrar cantidad de productos sin vender -->
    <!-- Debe mostrar tabla con los productos que no han sido comprados -->
</body>
</html>
