<?php

// Ejercicio 3 - Partida de dados 

// Escriba un programa que enfrente a dos jugadores tirando una serie de dados al azar.

// Cada jugador tira el dado de 6 veces.
// Los dados se comparan en orden (el primero con el primero, el segundo con el segundo, etc.) y gana el jugador que obtenga 
// el número más alto.
// Mostrar un resumen con cuántas rondas ha ganado cada jugador.
// Mostrar que jugador ha ganado la partida completa.
// NOTA: A la hora de mostrar los dados de cada jugador utiliza la estructura foreach



$jugador1 = [];
$imagenes1 = [];
$j1win = 0;
$j2win = 0;
$empate = 0;
$mensaje = "";
$mensaje2 = "";

for ($i = 0; $i <= 5; $i++):

    $dado1 = mt_rand(1, 6);
    $jugador1 [$i] = $dado1;
    $dado2 = mt_rand(1, 6);
    $jugador2 [$i] = $dado2;
    $imagenes2[$i] = "<img src='dados/$dado2.svg' alt='dado' width='100'>";

    if ($dado1 > $dado2):
        $j1win++;
    elseif ($dado2 > $dado1):
        $j2win++;
    else:
        $empate++;
    endif;

endfor;

if ($j1win != 0):
        $mensaje .= "El <b>Jugador 1</b> ha ganado <b>$j1win</b> veces. ";
endif;
if ($j2win != 0):
    $mensaje .= "El <b>Jugador 2</b> ha ganado <b>$j2win</b> veces. ";
endif;
if ($empate != 0):
    $mensaje .= "Los jugadores han empatado <b>$empate</b> veces.";
endif;

if ($j1win > $j2win):
    $mensaje2 = "El <b>jugador 1</b> ha ganado la partida!!";
else:
    $mensaje2 = "El <b>jugador 2</b> ha ganado la partida!!";
endif;

?>

<!-- Usamos un HTML para mostrar todo -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Partida de Dados</title>
</head>
<body>
    <h2>Dados</h2> 
    <table border="1" cellpadding="5">
        <tr>
            <th>Jugador 1</th>
            <!-- Usamos un ciclo for para mostrar todas las posiciones del bit normal -->
            <?php for ($i = 0; $i <= 5; $i++): ?>
                <th><img src='dados/<?= $jugador1[$i] ?>.svg' alt='dado' width='100'></th>
            <?php endfor; ?>
        </tr>
        <tr>
            <th>Jugador 2</th>
            <!-- Usamos un ciclo for para mostrar todas las posiciones del bit invertido -->
            <?php for ($i = 0; $i <= 5; $i++): ?>
                <th><img src='dados/<?= $jugador2[$i] ?>.svg' alt='dado' width='100'></th>
            <?php endfor; ?>
        </tr>
    </table>
    <br>
    <p><?= $mensaje ?><br></p>
    <p><?= $mensaje2 ?><br></p>
</body>
</html>
