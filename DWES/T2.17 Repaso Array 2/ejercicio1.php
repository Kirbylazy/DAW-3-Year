<!-- ### Ejercicio 1: Contar productos por categoría
**Función PHP:** `count`
**Función a implementar:** `contarProductosPorCategoria(array $productos, string $categoria): int`

**Frontend:**
- Formulario con select de categorías (generado dinámicamente con `obtenerCategorias()`)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Tabla con todos los productos de la categoría seleccionada
- Columnas: ID, Nombre, Precio, Stock, Valoración
- Total de productos al final -->

<?php 
include_once ('funciones.php'); 
include_once ('datos.php');

$cantidad = 0;
?>
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
            <?php $categorias = obtenerCategorias($productos);
                    foreach ($categorias as $categoria):?>
            <option value="<?= $categoria ?>"><?= $categoria ?></option>
            <?php endforeach ?>
        </select>
        <button type="submit" name="submit">Ejecutar</button>
        <br>
        <br>
    </form>
        <table border="1" cellpadding="5">
            <tr>
                <td>Nombre</td><td>Precio</td><td>Stock</td><td>Valoracion</td>
            </tr>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST"):

                if (isset($_POST["submit"])):

                    foreach ($productos[$_POST['categoria']] as $producto):
                    
                    $cantidad = $cantidad + $producto['stock'];

                    ?>

                
                    <tr>
                        <td><?= $producto["nombre"] ?></td>
                        <td><?= $producto["precio"] ?> €</td>
                        <td><?= $producto["stock"] ?></td>
                        <td><?= $producto["valoracion"] ?></td>
                    </tr>

                    <?php endforeach ?>

        </table>

                    <p>En total hay <?= $cantidad ?> productos</p>
                <?php endif ?>
            <?php endif ?>
</body>
</html>
