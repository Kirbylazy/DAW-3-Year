<!-- ### Ejercicio 7: Idiomas por nivel de un cliente
**Funciones PHP:** `foreach` + condicionales
**Función a implementar:** `obtenerIdiomasPorNivel(array $clientes, string $idCliente, string $nivel): array`

**Frontend:**
- Formulario con:
  - Select de clientes (generado dinámicamente)
  - Input text para nivel (ej: nativo, C1, B2, A2)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Lista de idiomas del cliente con ese nivel
- Tabla con todos los idiomas del cliente para contexto -->

<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 7 - Idiomas por nivel de un cliente</title>
</head>
<body>
    <h1>Ejercicio 7: Idiomas por nivel de un cliente</h1>

    <form method="POST">
        <label for="idCliente">ID Cliente:</label>
        <select name="idCliente" id="idCliente" required>
            <?php $ids = obtenerIdsClientes($clientes);
                    foreach ($ids as $id):?>
            <option value="<?= $id ?>"><?= $id ?></option>
            <?php endforeach ?>
        </select>
        <br><br>
        <label for="nivel">Nivel:</label>
        <input type="text" name="nivel" id="nivel" placeholder="Ej: nativo, C1, B2, A2" required>
        <br><br>
        <button type="submit" name="submit">Ejecutar</button>
    </form>
    <br><br>
    
        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"):

                if (isset($_POST["submit"])):?>
                <table border="1" cellpadding="5">
                    <tr>
                        <th>Cliente</th><th>Idiomas por NV</th><th>Idiomas</th>
                    </tr>
                    <?php 
                    $idCliente = $_POST['idCliente'];
                    $nivel = $_POST['nivel'];
                    $idiomasNv = obtenerIdiomasPorNivel($clientes, $idCliente, $nivel); 
                    $idiomas = [];
                    foreach ($clientes[$idCliente]['idiomas'] as $idioma => $nivel) {
                        $idiomas[] = "$idioma ($nivel)";
                    }?>

                    <tr>
                        <td><?= $idCliente ?></td>
                        <td><?= implode(', ', $idiomasNv) ?> </td>
                        <td><?= implode(', ', $idiomas) ?></td>
                    </tr>
        </table>
    <?php endif ?> 
    <?php endif ?> 
</body>
</html>
