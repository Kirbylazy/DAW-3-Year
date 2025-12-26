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
    <br><br>
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"):

                if (isset($_POST["submit"])):
                
                echo 'El numero de productos sin vender es: <strong>' . contarProductosSinVender($productos, $clientes) . '<strong>';?>
                
    <?php endif ?> 
    <?php endif ?>
</body>
</html>
