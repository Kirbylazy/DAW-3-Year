<?php

// Ejercicio 2 - Negación de bits
// Actualice la página para mostrar una secuencia aleatoria de bits y su complementaria.

//Creamos los dos arrays que vamos a usar en el ejercicio

$bits = [];
$bitsInv = [];

//Con un for asignamos alatoriamente 0 o 1 en cada bit hasta 10 posiciones
for ($i = 0; $i <= 9; $i++):
    $bit = mt_rand(0, 1);
    $bits[$i] = $bit;

    //Con un if invertimos el valor de cada bit para obtener el inverso
    if ($bit === 1):
        $bitInv = 0;
    elseif ($bit === 0):
        $bitInv = 1;
    else:
        echo "esto no es un bit";
    endif;

    $bitsInv[$i] = $bitInv;
endfor;
?>

<!-- Usamos un HTML para mostrar todo -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Código Binario</title>
</head>
<body>
    <h2>Bits</h2> 
    <table border="1" cellpadding="5">
        <tr>
            <th>Bits</th>
            <!-- Usamos un ciclo for para mostrar todas las posiciones del bit normal -->
            <?php for ($i = 0; $i <= 9; $i++): ?>
                <th><?= $bits[$i] ?></th>
            <?php endfor; ?>
        </tr>
        <tr>
            <th>Bits Invertidos</th>
            <!-- Usamos un ciclo for para mostrar todas las posiciones del bit invertido -->
            <?php for ($i = 0; $i <= 9; $i++): ?>
                <th><?= $bitsInv[$i] ?></th>
            <?php endfor; ?>
        </tr>
    </table>
</body>
</html>
