<!-- ### Ejercicio 12: Contar categorías de productos
**Funciones PHP:** `array_keys` + `count`
**Función a implementar:** `contarCategorias(array $productos): int`

**Frontend:**
- Formulario con solo botón "Ejecutar"

**Resultado a mostrar:**
- Número total de categorías
- Tabla con categorías y cantidad de productos en cada una -->

<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 12 - Contar categorias de productos</title>
</head>
<body>
    <h1>Ejercicio 12: Contar categorias de productos</h1>

    <form method="POST">
        <button type="submit" name="submit">Ejecutar</button>
    </form>
    <br><br>
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"):

                if (isset($_POST["submit"])):
                
                echo 'El numero de categorias es: <strong>' . contarCategorias($productos) . '<strong>';?>
                
    <?php endif ?> 
    <?php endif ?>
</body>
</html>
