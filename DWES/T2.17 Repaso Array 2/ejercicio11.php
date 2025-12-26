<!-- ### Ejercicio 11: Productos únicos de proveedores
**Función PHP:** `array_unique`
**Función a implementar:** `obtenerProductosUnicos(array $proveedores): array`

**Frontend:**
- Formulario con solo botón "Ejecutar"

**Resultado a mostrar:**
- Tabla con productos únicos suministrados por todos los proveedores
- Total de productos únicos -->

<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 11 - Productos unicos de proveedores</title>
</head>
<body>
    <h1>Ejercicio 11: Productos unicos de proveedores</h1>

    <form method="POST">
        <button type="submit" name="submit">Ejecutar</button>
    </form>
    <br><br>
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"):

                if (isset($_POST["submit"])):
                
                echo implode(', ', obtenerProductosUnicos($proveedores));?>
                
    <?php endif ?> 
    <?php endif ?> 
</body>
</html>
