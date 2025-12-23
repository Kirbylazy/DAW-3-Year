<!-- ### Ejercicio 2: Contar idiomas de un cliente
**Función PHP:** `count`
**Función a implementar:** `contarIdiomasCliente(array $clientes, string $idCliente): int`

**Frontend:**
- Formulario con select de clientes (generado dinámicamente con `obtenerIdsClientesAux()`)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Tabla con todos los idiomas del cliente
- Columnas: Idioma, Nivel
- Total de idiomas al final -->

<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2 - Contar idiomas de un cliente</title>
</head>
<body>
    <h1>Ejercicio 2: Contar idiomas de un cliente</h1>

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
    <br>
    <br>
    </form>
        <table border="1" cellpadding="5">
            <tr>
                <td>Nombre</td><td>Email</td><td>Ciudad</td><td>Idiomas</td>
            </tr>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST"):

                if (isset($_POST["submit"])):

                    $idCliente = $_POST['idCliente'];

                    $cantidad = contarIdiomasCliente($clientes,$idCliente);
                    ?>

                    <tr>
                        <td><?= $clientes[$idCliente]['datos']["nombre"] ?></td>
                        <td><?= $clientes[$idCliente]['datos']["email"] ?> </td>
                        <td><?= $clientes[$idCliente]['datos']["ciudad"] ?></td>
                        <td><?= $cantidad ?></td>
                    </tr>

        </table>

                <?php endif ?>
            <?php endif ?>
</body>
</html>
