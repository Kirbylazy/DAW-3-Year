<!-- ### Ejercicio 18: Clientes que compraron producto
**Funciones PHP:** `in_array` + `foreach`
**Función a implementar:** `obtenerClientesPorProducto(array $clientes, string $idProducto): array`

**Frontend:**
- Formulario con input text para ID de producto
- Botón "Ejecutar"

**Resultado a mostrar:**
- Tabla con clientes que compraron el producto
- Columnas: ID Cliente, Nombre
- Total de clientes -->

<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 18 - Clientes que compraron producto</title>
</head>
<body>
    <h1>Ejercicio 18: Clientes que compraron producto</h1>

    <form method="POST">
        <label for="idProducto">ID Producto:</label>
        <input type="text" name="idProducto" id="idProducto" placeholder="Ej: P001, M001, T001" required>
        <button type="submit" name="submit">Ejecutar</button>
    </form>
    <br><br>
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"):

                if (isset($_POST["submit"])):
                $idProducto = $_POST['idProducto'];
                $ranking = obtenerClientesPorProducto($clientes, $idProducto);?>
                <table border="1" cellpadding="5"><br><br>
                    <tr>
                        <th>Id</th><th>Nombre</th>
                    </tr>
                    <?php  
                    foreach ($ranking as $cliente){ ?>

                    <tr>
                        <td><?= $cliente[0] ?></td>
                        <td><?= $cliente[1] ?></td>
                    </tr>

                    <?php } ?>
        </table>
    <?php endif ?> 
    <?php endif ?> 
</body>
</html>
