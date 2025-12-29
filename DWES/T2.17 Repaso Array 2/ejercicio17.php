<!-- ### Ejercicio 17: Idiomas adicionales entre clientes
**Funciones PHP:** `array_diff_key` + `count`
**Función a implementar:** `contarIdiomasAdicionales(array $clientes, string $idCliente1, string $idCliente2): int`

**Frontend:**
- Formulario con:
  - Select para Cliente 1 (generado dinámicamente)
  - Select para Cliente 2 (generado dinámicamente)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Cantidad de idiomas adicionales que habla cliente1 respecto a cliente2 -->

<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 17 - Idiomas adicionales entre clientes</title>
</head>
<body>
    <h1>Ejercicio 17: Idiomas adicionales entre clientes</h1>

    <form method="POST">
        <label for="idCliente1">Cliente 1:</label>
        <select name="idCliente1" id="idCliente1" required>
            <?php $ids = obtenerIdsClientes($clientes);
                    foreach ($ids as $id):?>
            <option value="<?= $id ?>"><?= $id ?></option>
            <?php endforeach ?>
        </select>
        <br><br>
        <label for="idCliente2">Cliente 2:</label>
        <select name="idCliente2" id="idCliente2" required>
            <?php $ids = obtenerIdsClientes($clientes);
                    foreach ($ids as $id):?>
            <option value="<?= $id ?>"><?= $id ?></option>
            <?php endforeach ?>
        </select>
        <br><br>
        <button type="submit" name="submit">Ejecutar</button>
    </form>
    <br><br>
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"):

                if (isset($_POST["submit"])):

                    $idCliente1 = $_POST['idCliente1'];
                    $idCliente2 = $_POST['idCliente2'];
                    $resultado = contarIdiomasAdicionales($clientes, $idCliente1, $idCliente2);
                    
                    if($resultado >= 1){
                        echo $clientes[$idCliente1]['datos']['nombre'] . ' (primer cliente) sabe ' . $resultado . ' iniomas más que ' . $clientes[$idCliente2]['datos']['nombre'] . ' (segundo cliente).';
                    }elseif($resultado <= -1){
                        echo $clientes[$idCliente1]['datos']['nombre'] . ' (primer cliente) no sabe mas idiomas que ' . $clientes[$idCliente2]['datos']['nombre'] . ' (segundo cliente).';
                    }else{
                        echo 'Ambos clientes saben la misma cantidad de idiomas.';
                    }?> 

    <?php endif ?> 
    <?php endif ?>   
</body>
</html>
