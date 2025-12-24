<!-- ### Ejercicio 5: Precio máximo de una categoría
**Función PHP:** `max`
**Función a implementar:** `obtenerPrecioMaximoCategoria(array $productos, string $categoria): float`

**Frontend:**
- Formulario con select de categorías (generado dinámicamente)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Mensaje con el precio máximo
- Tabla con todos los productos y sus precios de la categoría -->

<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 5 - Precio maximo de una categoria</title>
</head>
<body>
    <h1>Ejercicio 5: Precio maximo de una categoria</h1>

    <form method="POST">
        <label for="categoria">Categoria:</label>
        <select name="categoria" id="categoria" required>
            <?php foreach ($productos as $categoria => $key):?>
            <option value="<?= $categoria ?>"><?= $categoria ?></option>
            <?php endforeach ?>
        </select>
        <button type="submit" name="submit">Ejecutar</button>
    </form>
    <br><br>

    <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST"):

                if (isset($_POST["submit"])):

                    $categoria = $_POST['categoria'];
                    $maxProducto = obtenerPrecioMaximoCategoria($productos, $categoria);
                    ?>

                    <table border="1" cellpadding="5">
                        <tr>
                            <th>Id</th><th>Nombre</th><th>Precio</th><th>Valoración</th>
                        </tr>
                        <tr>
                            <td><?= $maxProducto['id'] ?></td>
                            <td><?= $maxProducto['nombre'] ?></td>
                            <td><?= $maxProducto['precio'] ?>€</td>
                            <td><?= $maxProducto['valoracion'] ?></td>
                        </tr>

                    </table>

                <?php endif ?>
            <?php endif ?>
</body>
</html>
