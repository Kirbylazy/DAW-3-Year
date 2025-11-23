<?php

// Realiza un formulario en el que haya dos campos numéricos de entrada y una lista desplegable que incluya las 4 operaciones básicas 
// (sumar, restar, multiplicar, dividir). Con un botón "=", mostramos el resultado.

//Iniciamos declarando todas las variables que vamos a usar

$n1 = 0;//Pirmer número
$n2 = 0;//Segundo número
$resultado = 0;//Resultado final
$operador = "";//Tipo de operación
$mensaje = "";//Mensaje a mostrar con el resultado

?>

<!-- Construimos la pagina a mostrar en html -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Variables</title>
</head>
<body>
    <h2>Calculadora</h2>

    <!-- Creamos un formulario para recoger todos los datos -->

    <form method="post" action="">

        <!-- Pedimos el primer numero -->

        <label for="n1">Primer número:</label> 
        <input type="number" name="n1" id="n1" required>

        <!-- Pedimos el segundo numero -->

        <label for="n2"><br><br>Segundo número:</label>
        <input type="number" name="n2" id="n2" required>

        <!-- Creamos el desplegable de opciones para elegir operador -->
        
        <label for="operado"><br><br>Elige un operador:</label>
            <select id="operador" name="operador">
            <option value="sumar">Sumar</option>
            <option value="restar">Restar</option>
            <option value="multiplicar">Multiplicar</option>
            <option value="dividir">Dividir</option>
            </select>

        <!-- Creamos el botón para confirma que se puede realizar la operación -->

        <button type="submit" name="confirmar">=</button>
        <p><br></p>

    </form>

    <?php

    // Recogemos todos los datos desde el post

    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        // Asignamos a cada variable su valor

        $n1 = $_POST["n1"];
        $n2 = $_POST["n2"];
        $operador = $_POST["operador"];

        // Una vez pulsado el botón podemos empezar a operar

        if (isset($_POST['confirmar'])) {

            // Usamos un Switch para saber que opción elige el usuario y actuamos en consecuencia.

            switch ($operador) {
                case 'sumar':
                    $resultado = $n1 + $n2;
                    $mensaje = "El resultado de $operador $n1 y $n2 es: <b>$resultado</b>";
                    break;

                case 'restar':
                    $resultado = $n1 - $n2;
                    $mensaje = "El resultado de $operador $n1 y $n2 es: <b>$resultado</b>";
                    break;

                case 'multiplicar':
                    $resultado = $n1 * $n2;
                    $mensaje = "El resultado de $operador $n1 y $n2 es: <b>$resultado</b>";
                    break;

                case 'dividir':
                    $resultado = $n1 / $n2;
                    $mensaje = "El resultado de $operador $n1 y $n2 es: <b>$resultado</b>";
                    break;

                default:
                    $mensaje = "Usted ha elegido una opción incorrecta";
                    break;
            }
        }
    }
    ?>

    <!-- En todos los casos del switch hemos elaborado un mensaje personalizado para mostrar al fianl del programa -->

    <h3>Resultado<br></h3>
        <p><?= $mensaje ?></p>

</body>
</html>

