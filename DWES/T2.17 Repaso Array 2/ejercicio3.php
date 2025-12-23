<!-- ### Ejercicio 3: Verificar si cliente compró producto
**Función PHP:** `in_array`
**Función a implementar:** `clienteComproProducto(array $clientes, string $idCliente, string $idProducto): bool`

**Frontend:**
- Formulario con:
  - Select de clientes (generado dinámicamente)
  - Input text para ID de producto
- Botón "Ejecutar"

**Resultado a mostrar:**
- Mensaje indicando si el cliente SÍ o NO compró el producto
- Tabla con todas las compras del cliente -->

<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

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
            <?php $ids = obtenerIdsClientes($clientes);
                    foreach ($ids as $id):?>
            <option value="<?= $id ?>"><?= $id ?></option>
            <?php endforeach ?>
        </select>
        <br><br>
        <label for="idProducto">ID Producto:</label>
        <select name="idProducto" id="idProducto" required>

        <?php foreach ($productos as $categoria => $listaProductos): ?>
            <?php foreach ($listaProductos as $idProducto => $producto): ?>
                <option value="<?= $idProducto ?>">
                    <?= $idProducto ?> - <?= $producto['nombre'] ?>
                </option>
            <?php endforeach; ?>
        <?php endforeach; ?>

        </select>
        <br><br>
        <button type="submit" name="submit">Ejecutar</button>
    </form>
    
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST"):

                if (isset($_POST["submit"])):

                    $idCliente = $_POST['idCliente'];
                    $idProducto = $_POST['idProducto'];
                    $respuesta = in_array($idProducto, $clientes[$idCliente]['compras']);
                    echo 'El cliente ' . $clientes[$idCliente]['datos']['nombre'] . 
                         ' <strong>' . ($respuesta ? 'Sí' : 'No') . '</strong> ha comprado el producto';
                    ?>

                    <table border="1" cellpadding="5">
                        <tr>
                            <td>Productos</td>
                        </tr>

                       <?php foreach ($clientes[$idCliente]['compras'] as $producto):

                    ?>

                
                    <tr>
                        <td><?= $producto ?></td>
                    </tr>

                    <?php endforeach ?>

                    </table>

                <?php endif ?>
            <?php endif ?>
</body>
</html>
