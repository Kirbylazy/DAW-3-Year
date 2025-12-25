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
            <?php $ids = obtenerIdsClientes($clientes);
                    foreach ($ids as $id):?>
            <option value="<?= $id ?>"><?= $id ?></option>
            <?php endforeach ?>
        </select>
        <button type="submit" name="submit">Ejecutar</button>
    </form>
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"):

                if (isset($_POST["submit"])):?>
                <table border="1" cellpadding="5">
                    <tr>
                        <th>Cliente</th><th>Productos no comprados</th>
                    </tr>
                    <?php 
                    $idCliente = $_POST['idCliente'];
                    $productosNC = obtenerProductosNoComprados($productos, $clientes, $idCliente);?>
                    <tr>
                        <td><?= $idCliente ?></td>
                        <td><?= implode(', ', $productosNC) ?> </td>
                    </tr>
        </table>
    <?php endif ?> 
    <?php endif ?> 
</body>
</html>
