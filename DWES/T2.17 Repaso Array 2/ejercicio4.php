<!-- ### Ejercicio 4: Obtener IDs de clientes
**Función PHP:** `array_keys`
**Función a implementar:** `obtenerIdsClientes(array $clientes): array`

**Frontend:**
- Formulario con solo botón "Ejecutar"

**Resultado a mostrar:**
- Lista de todos los IDs de clientes -->

<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 4 - Obtener IDs de clientes</title>
</head>
<body>
    <h1>Ejercicio 4: Obtener IDs de clientes</h1>

    <form method="POST">
        <button type="submit" name="submit">Ejecutar</button>
    </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST"):

                if (isset($_POST["submit"])):

                    $ids = obtenerIdsClientes($clientes);
        ?>
                <table border="1" cellpadding="5">
                    <tr>
                        <td>Id</td><td>Nombre</td>
                    </tr>

                    <?php
                    foreach ($ids as $id):
                    ?>
                
                    <tr>
                        <td><?= $id ?></td>
                        <td><?= $clientes[$id]['datos']["nombre"] ?></td>
                    </tr>

                    <?php endforeach ?>
                    <?php endif ?>
                    <?php endif ?>

        </table>
</body>
</html>
