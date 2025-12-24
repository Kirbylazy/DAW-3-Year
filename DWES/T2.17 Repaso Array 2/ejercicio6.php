<!-- ### Ejercicio 6: Contar compras por cliente
**Funciones PHP:** `count` + `foreach`
**Función a implementar:** `contarComprasPorCliente(array $clientes): array`

**Frontend:**
- Formulario con solo botón "Ejecutar"

**Resultado a mostrar:**
- Tabla con todos los clientes
- Columnas: ID Cliente, Cantidad de Compras, Productos Comprados -->

<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 6 - Contar compras por cliente</title>
</head>
<body>
    <h1>Ejercicio 6: Contar compras por cliente</h1>

    <form method="POST">
        <button type="submit" name="submit">Ejecutar</button>
    </form>
    <br><br>
    
        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"):

                if (isset($_POST["submit"])):?>
                <table border="1" cellpadding="5">
                    <tr>
                        <th>Cliente</th><th>N compras</th><th>Productos</th>
                    </tr>
                    <?php $nProductos = contarComprasPorCliente($clientes); 
                            foreach ($nProductos as $cliente){ ?>

                    <tr>
                        <td><?= $cliente['id'] ?></td>
                        <td><?= $cliente['nCompras'] ?> </td>
                        <td><?= implode(', ', $cliente['productos']) ?></td>
                    </tr>
                            <?php } ?>
        </table>
    <?php endif ?> 
    <?php endif ?> 
</body>
</html>
