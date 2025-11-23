<?php
// Ejercicio 1.

// Realiza lo siguiente en una página web.
// Define 2 constantes.
// EurPta con valor 166.386
// PtaEur con valor 1/166.386
// Y te debe mostrar por pantalla lo siguiente:
// Valor de la constante "EurPta": '166.386'
// Valor de la constante "PtaEur": '0.0060101210438378'
//  Ejercicio 1b.

// Utilizando las constantes anteriores, escribe una página con un formulario en el que se le podrá introducir una cifra 
// (que serán euros o pesetas) y mediante dos botones se podrá pasar esa cifra a pesetas o a euros.


$EurPta = 166.386;
$PtaEur = 1/$EurPta;
$resultado = 0;

echo "<p> Valor de la constante EurPta: $EurPta </p>";
echo "<p> Valor de la constante PtaEur: $PtaEur </p>";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Conversor de Divisas</title>
</head>
<body>
    <h2>Introduce un importe a convertir</h2>

    <form method="post" action="">
        <label for="importe">importe:</label>
        <input type="number" name="importe" id="importe" required>
        <button type="submit" name="pe">Pasar a Euros</button>
        <button type="submit" name="ep">Pasar a Pesetas</button>
    </form>

    <?php
    // Ejercicio 1b
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $importe = $_POST["importe"];

        if (isset($_POST['pe'])) {
            $resultado = $importe * $PtaEur;
            echo "$importe pesetas son $resultado €";
        } elseif (isset($_POST['ep'])) {
            $resultado = $importe * $EurPta;
            echo "$importe € son $resultado Pesetas";
        }
    }
    ?>

</body>
</html>