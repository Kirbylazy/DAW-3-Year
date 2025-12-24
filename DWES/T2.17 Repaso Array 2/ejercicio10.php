<!-- ### Ejercicio 10: Reindexar idiomas de cliente
**Función PHP:** `array_values`
**Función a implementar:** `reindexarIdiomasCliente(array $clientes, string $idCliente): array`

**Frontend:**
- Formulario con select de clientes (generado dinámicamente)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Tabla de niveles de idiomas reindexados desde 0
- Columnas: Índice, Nivel -->

<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 10 - Reindexar idiomas de cliente</title>
</head>
<body>
    <h1>Ejercicio 10: Reindexar idiomas de cliente</h1>

    <form method="POST">
        <label for="idCliente">ID Cliente:</label>
        <label for="idCliente">ID Cliente:</label>
        <select name="idCliente" id="idCliente" required>
            <?php $ids = obtenerIdsClientes($clientes);
                    foreach ($ids as $id):?>
            <option value="<?= $id ?>"><?= $id ?></option>
            <?php endforeach ?>
        </select>
        <button type="submit" name="submit">Ejecutar</button>
    </form>
    <br><br>

    <?php 
    // No se si es exactamente esto lo que pedias
        if ($_SERVER["REQUEST_METHOD"] == "POST"):

                if (isset($_POST["submit"])):?>
                <table border="1" cellpadding="5">
                    <tr>
                        <th>Indice</th><th>Niveles</th>
                    </tr>
                    <?php 
                    $idCliente = $_POST['idCliente'];
                    $idiomasNv = reindexarIdiomasCliente($clientes, $idCliente); 
                    foreach ($idiomasNv as $i => $nivel){ ?>

                    <tr>
                        <td><?= $i?></td>
                        <td><?= $nivel ?> </td>
                    </tr>

                    <?php } ?>
        </table>
    <?php endif ?> 
    <?php endif ?> 
</body>
</html>
