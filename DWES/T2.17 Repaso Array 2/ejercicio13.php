<!-- ### Ejercicio 13: Empleado mejor pagado
**Funciones PHP:** `max` + `foreach`
**Función a implementar:** `obtenerEmpleadoMejorPagado(array $empleados, string $departamento): string`

**Frontend:**
- Formulario con select de departamentos (generado dinámicamente)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Nombre del empleado mejor pagado
- Tabla con todos los empleados del departamento -->

<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 13 - Empleado mejor pagado</title>
</head>
<body>
    <h1>Ejercicio 13: Empleado mejor pagado</h1>

    <form method="POST">
        <label for="departamento">Departamento:</label>
        <select name="departamento" id="departamento" required>
            <?php $ids = obtenerDepartamentos($empleados);
                    foreach ($ids as $id):?>
            <option value="<?= $id ?>"><?= $id ?></option>
            <?php endforeach ?>
        </select>
        <button type="submit" name="submit">Ejecutar</button>
    </form>
    <br><br>
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"):

                if (isset($_POST["submit"])):
                $departamento = $_POST['departamento'];
                echo 'El empleado/a con mayor salario es: <strong>' . obtenerEmpleadoMejorPagado($empleados, $departamento) . '</strong>';?>
                <table border="1" cellpadding="5"><br><br>
                    <tr>
                        <th>Nombre</th><th>Salario</th>
                    </tr>
                    <?php  
                    foreach ($empleados[$departamento] as $empleado){ ?>

                    <tr>
                        <td><?= $empleado['nombre']?></td>
                        <td><?= $empleado['salario']?>€</td>
                    </tr>

                    <?php } ?>
        </table>
    <?php endif ?> 
    <?php endif ?> 
    <!-- TODO: Mostrar resultado cuando se envie el formulario -->
    <!-- Debe mostrar el nombre del empleado mejor pagado -->
    <!-- Debe mostrar tabla con todos los empleados del departamento -->
</body>
</html>
