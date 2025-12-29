<!-- ### Ejercicio 16: Ranking de productos más comprados
**Funciones PHP:** `array_count_values` + `arsort`
**Función a implementar:** `obtenerRankingProductos(array $clientes): array`

**Frontend:**
- Formulario con solo botón "Ejecutar"

**Resultado a mostrar:**
- Tabla con ranking de productos
- Columnas: ID Producto, Veces Comprado
- Ordenado de mayor a menor -->

<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 16 - Ranking de productos mas comprados</title>
</head>
<body>
    <h1>Ejercicio 16: Ranking de productos mas comprados</h1>

    <form method="POST">
        <button type="submit" name="submit">Ejecutar</button>
    </form>
    <br><br>
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"):

                if (isset($_POST["submit"])):
                $ranking = obtenerRankingProductos($clientes)?>
                <table border="1" cellpadding="5"><br><br>
                    <tr>
                        <th>Id</th><th>N ventas</th>
                    </tr>
                    <?php  
                    foreach ($ranking as $i => $producto){ ?>

                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $producto ?> ud.</td>
                    </tr>

                    <?php } ?>
        </table>
    <?php endif ?> 
    <?php endif ?> 
</html>
