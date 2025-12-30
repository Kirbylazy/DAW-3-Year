<!-- ### Ejercicio 19: Productos exclusivos por tipo proveedor
**Funciones PHP:** `array_diff` + `array_unique`
**Función a implementar:** `obtenerProductosExclusivos(array $proveedores, string $tipo1, string $tipo2): array`

**Frontend:**
- Formulario con:
  - Select para tipo de proveedor 1 (nacional/internacional)
  - Select para tipo de proveedor 2 (nacional/internacional)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Tabla con productos exclusivos del tipo1
- Productos que suministran proveedores tipo1 pero NO tipo2 -->

<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 19 - Productos exclusivos por tipo proveedor</title>
</head>
<body>
    <h1>Ejercicio 19: Productos exclusivos por tipo proveedor</h1>

    <form method="POST">
        <label for="tipo1">Tipo de proveedor 1:</label>
        <select name="tipo1" id="tipo1" required>
            <option value="">-- Selecciona tipo 1 --</option>
            <option value="nacional">nacional</option>
            <option value="internacional">internacional</option>
        </select>
        <br><br>
        <label for="tipo2">Tipo de proveedor 2:</label>
        <select name="tipo2" id="tipo2" required>
            <option value="">-- Selecciona tipo 2 --</option>
            <option value="nacional">nacional</option>
            <option value="internacional">internacional</option>
        </select>
        <br><br>
        <button type="submit" name="submit">Ejecutar</button>
    </form>
    <br><br>
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"):

                if (isset($_POST["submit"])):
                $tipo1 = $_POST['tipo1'];
                $tipo2 = $_POST['tipo2'];
                $lista = [];?>
                <a>Lista de produtos de tipo <?= $tipo1 ?>:</a>
                <table border="1" cellpadding="5"><br><br>
                    <tr>
                        <th>Id</th>
                    </tr>
                    <?php  
                    foreach ($proveedores as $proveedor){ 
                        
                        $lista = array_merge($lista,$proveedor['productos']);
                    }
                    
                    foreach($lista as $producto){?>

                    <tr>
                        <td><?= $producto ?></td>
                    </tr>

                    <?php } //He tenido que implementar esta función aqui por que no existe en la lista de funciones ?>

                    </table>
                    <br><br>
                    
                    <?php $ranking = obtenerProductosExclusivos($proveedores, $tipo1, $tipo2);

                    echo implode(', ', $ranking); ?>
    <?php endif ?> 
    <?php endif ?> 
</body>
</html>
