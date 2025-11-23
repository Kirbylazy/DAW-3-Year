<?php
// Ejercicio 2. 
// 
// Pide al usuario un número de segundos y conviértelo a formato "X horas, Y minutos, Z segundos". 
// Puedes utilizar la operación "módulo".

// Ejemplo: 3665 segundos → "1 hora, 1 minuto, 5 segundos"

$Segundos = 0;
$Seg = 0;
$Minutos = 0;
$Horas = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Conversor de Segundos</title>
</head>
<body>
    <h2>Introduce Los segundos a convertir</h2>

    <form method="post" action="">
        <label for="Segundos">Segundos:</label>
        <input type="number" name="Segundos" id="Segundos" required>
        <button type="submit" name="Convertir">Convertir</button>
    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $Segundos = $_POST["Segundos"];

        if (isset($_POST['Convertir'])) {
            $Horas = $Segundos / 3600;
            $Minutos = ($Segundos % 3600) / 60;
            $Seg = ($Segundos % 3600) % 60;
            $Horas = (int)$Horas;
            $Minutos = (int)$Minutos;
            $Seg = (int)$Seg;

            echo "$Segundos Segundos son:$Horas horas, $Minutos minutos y $Seg Segundos";
        }
    }
    ?>

</body>
</html>