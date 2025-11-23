<?php

// 3.- Escribe un programa salario.php que calcule el salario de un trabajador una vez que se le descuente el impuesto.

// Se usarán las variables: $salario, $impuesto, que vendrá dada en porcentaje.

// Se deberá descontar el porcentaje del impuesto por ciento a $salario y se guardará en la variable $resultado. 
// Después deberá mostrarse una de la siguiente información:

// “El salario sin descontar el impuesto: xxxxx”

// “El salario 'xxxx' una vez descontado: zzzz”

// Deberán mostrarse las comillas, y el título de la página será: Salario.

// Los datos del salario y del impuesto se introducirán mediante un formulario.

// Habrá 2 botones, uno para que muestre la primera información y otro para que te muestre la segunda.


$salario = 0;
$impuesto = 0;
$resultado = 0;

?>

<!-- Construimos la pagina a mostrar en html -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Salario</title>
</head>
<body>
    <h2>Calculo de salario</h2>

    <!-- Creamos un formulario para recoger todos los datos -->

    <form method="post" action="">

        <!-- Pedimos el Salario -->

        <label for="importe">Salario:</label> 
        <input type="number" name="salario" id="salario" required>
        <br><br>

        <!-- Pedimos el impuesto -->
        <label for="importe">Impuestos:</label> 
        <input type="float" name="impuestos" id="impuestos" required>
        <br><br>

        <!-- Creamos el botón para confirmar -->

        <button type="submit" name="sinImpuestos">sin impuestos</button>
        <br><br>
        <button type="submit" name="conImpuestos">con impuestos</button>
        <br><br>

    </form>

<?php

// Recogemos todos los datos desde el post

    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        // Asignamos a cada variable su valor

        $salario = $_POST["salario"];
        $impuestos = $_POST["impuestos"];

        // Una vez pulsado el primer botón podemos mostra el salario

        if (isset($_POST['sinImpuestos'])) {

            echo "“El salario sin descontar el impuesto: ” " . $salario;
            echo "€";
        }

        // Una vez pulsado el segundo botón podemos hacer el calculo de los impuestos
        if (isset($_POST['conImpuestos'])) {

            $conImpuestos = $salario - ($salario * $impuestos / 100);

            echo "“El salario sin descontar el impuesto: ” " . $conImpuestos;
            echo "€";
        }
    }
?>

</body>
</html>