<?php

// Ejercicio 6 - Contar cartas

// Escriba un programa:

// Que muestre primero un grupo de entre 10 y 20 cartas de corazones numeradas del 1 al 10 al azar.
// Que indique cuántas veces ha aparecido cada una de las cartas.

$cartas = []; //Cramos la variable que vamos a usar

//Con un ciclo for elegimos el numero de cartas a mostrar y las almacenamos en el array

for ($i = 0; $i <= mt_rand(10, 20); $i++):

    $cartas[$i] = mt_rand(1, 10);

endfor;

$conteo = array_count_values($cartas); //Con el array_count_values creamos un array con los valores repetidos en $cartas

?>

<!-- Usamos un HTML para mostrar todo -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cartas Repetidas</title>
</head>
<body>
    <h2>Cartas <?php echo count($cartas)?></h2> 
    <table border="1" cellpadding="5">
        <tr>
            <th>Cartas</th>
            <!-- Usamos un ciclo for para mostrar todas las cartas -->
            <?php for ($i = 0; $i <= (count($cartas))-1; $i++): ?>
                <th><img src="cartas/c<?= $cartas[$i] ?>.svg" alt="carta" width="100"></th>
            <?php endfor; ?>
        </tr>
    </table>
            <h2>Cartas repetidas</h2>
            <!-- Usamos un ciclo foreach para mostrar todos los valores adquiridos por array_count_values -->
            <?php foreach ($conteo as $key => $value): ?>
                <p> el número <?= $key ?> se repite <?= $value ?> Veces.
            <?php endforeach; ?>
</body>
</html>