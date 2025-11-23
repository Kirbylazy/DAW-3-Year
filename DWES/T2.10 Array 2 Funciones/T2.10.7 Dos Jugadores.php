<?php

// Ejercicio 7 - Repartir cartas

// Escriba un programa:

// Que muestre un número par de cartas de corazones, entre 4 y 10, al azar y no repetidas.
// Que reparta las cartas entre dos jugadores, al azar.
// Quien más sume, gana.

//Cramos la variable que vamos a usar

$cartas = [1,2,3,4,5,6,7,8,9,10]; 
$numero = (mt_rand(2, 5)) * 2; 
$jugador1 = []; 
$jugador2 = []; 

//Con un ciclo for repartimos las cartas entre los dos jugadores

for ($i = 1; $i <= $numero; $i++):

    if ($i%2 == 0){
        shuffle($cartas);
        $jugador1[] = array_pop($cartas);
    }else{
        shuffle($cartas);
        $jugador2[] = array_pop($cartas);
    }
endfor;

//Asignamos los mensajes a mostrar con los puntos de cada jugador

$r1 = "El jugador 1 obtuvo " . array_sum($jugador1) . " puntos.";
$r2 = "El jugador 1 obtuvo " . array_sum($jugador2) . " puntos.";

//Con el ciclo if valoramos que jugador ha ganado y lo mostramos en un mensaje

if (array_sum($jugador1) < array_sum($jugador2)){

    $mensaje = "El Jugador 2 ha ganado!!";

}elseif (array_sum($jugador1) == array_sum($jugador2)){

    $mensaje = "Los jugadores están empatados!!";

}else{

    $mensaje = "El Jugador 1 ha ganado!!";

}
?>

<!-- Usamos un HTML para mostrar todo -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cartas Repetidas</title>
</head>
<body>
    <h2>Cartas</h2> 
    <table border="1" cellpadding="5">
        <tr>
            <th>jugador 1</th>
            <!-- Usamos un ciclo for para mostrar las cartas del jugador 1-->
            <?php for ($i = 0; $i < (count($jugador1)); $i++): ?>
                <th><img src="cartas/c<?= $jugador1[$i] ?>.svg" alt="carta" width="100"></th>
            <?php endfor; ?>
        </tr>
    </table>
    <table border="1" cellpadding="5">
        <tr>
            <th>jugador 2</th>
            <!-- Usamos un ciclo for para mostrar las cartas del jugador 2-->
            <?php for ($i = 0; $i < (count($jugador2)); $i++): ?>
                <th><img src="cartas/c<?= $jugador2[$i] ?>.svg" alt="carta" width="100"></th>
            <?php endfor; ?>
        </tr>
    </table>
    <!-- Mostramos la puntuación del jugador 1 -->
    <h3><?= $r1 ?></h3>
    <!-- Mostramos la puntuación del jugador 1 -->
    <h3><?= $r2 ?></h3>
    <!-- Mostramos el resultado -->
    <h2><?= $mensaje ?></h2>
</body>
</html>