<!-- ### Ejercicio 20: Estadísticas salariales por departamento
**Funciones PHP:** `max` + `min` + `count`
**Función a implementar:** `calcularEstadisticasSalariales(array $empleados): array`

**Frontend:**
- Formulario con solo botón "Ejecutar"

**Resultado a mostrar:**
- Tabla con estadísticas por departamento
- Columnas: Departamento, Salario Máximo, Salario Mínimo, Total Empleados -->


<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 20 - Estadisticas salariales por departamento</title>
</head>
<body>
    <h1>Ejercicio 20: Estadisticas salariales por departamento</h1>

    <form method="POST">
        <button type="submit" name="submit">Ejecutar</button>
    </form>
    <br><br>
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"):

                if (isset($_POST["submit"])):
                $ranking = calcularEstadisticasSalariales($empleados);?>
                <table border="1" cellpadding="5"><br><br>
                    <tr>
                        <th>Departamento</th><th>Salario Máximo</th><th>Salario Mínimo</th><th>N Empleados</th>
                    </tr>
                    <?php  
                    foreach ($ranking as $departamento => $datos){ ?>

                    <tr>
                        <td><?= $departamento ?></td>
                        <td><?= $datos['max'] ?></td>
                        <td><?= $datos['min'] ?></td>
                        <td><?= $datos['num'] ?></td>
                    </tr>

                    <?php } ?>
        </table>
    <?php endif ?> 
    <?php endif ?> 
</body>
</html>
