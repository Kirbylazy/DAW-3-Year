<!-- ### Ejercicio 8: Salario mínimo de un departamento
**Función PHP:** `min`
**Función a implementar:** `obtenerSalarioMinimoDepartamento(array $empleados, string $departamento): int`

**Frontend:**
- Formulario con select de departamentos (generado dinámicamente con `obtenerDepartamentos()`)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Mensaje con el salario mínimo
- Tabla con todos los empleados del departamento
- Columnas: ID Empleado, Nombre, Salario -->

<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 8 - Salario minimo de un departamento</title>
</head>
<body>
    <h1>Ejercicio 8: Salario minimo de un departamento</h1>

    <form method="POST">
        <label for="departamento">Departamento:</label>
        <select name="departamento" id="departamento" required>
            <?php $dep = obtenerDepartamentos($empleados);
            foreach ($dep as $departamento):?>
            <option value="<?= $departamento ?>"><?= $departamento ?></option>
            <?php endforeach ?>
        </select>
        <button type="submit" name="submit">Ejecutar</button>
    </form>
    <br><br>

    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"){

                if (isset($_POST["submit"])){
                $departamento = $_POST['departamento'];
                $salarioMin = obtenerSalarioMinimoDepartamento($empleados, $departamento);
                echo 'El salario minimo del departamento ' . '<strong>' . $departamento . '</strong>' . ', es de ' . '<strong>' . $salarioMin . '€' . '</strong>';
                }
            }?>
</html>
