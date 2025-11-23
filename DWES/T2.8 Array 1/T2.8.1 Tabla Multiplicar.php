<?php

// Ejercicio 1 - Tabla de multiplicar
// Escribe un programa que cada vez que se ejecute genere un número entre 1 y 10 al azar y 
// a continuación guarde en un array la tabla de multiplicar de dicho número. Saca también el valor mínimo y máximo del array generado.
// NOTA: Para generar el array utiliza la función range.

//Creamos las variables que vamos a usar
$numero = mt_rand(1, 10);
$tabla = [];

//Con el ciclo for contruimos el array con la tabla de multiplicar
for ($i = 1; $i <= 10; $i++) :

    $tabla[$i-1] = $numero * $i;

endfor;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tablas de multiplicar</title>
</head>
<body>
    <!--Construimos la tabla con un for usando el array -->
     <h2>Tablas de multiplicar</h2> 
    <table border="1">
        <tr>
            <th colspan="2"> Tabla del <?= $numero ?> </th>
        </tr>
        <?php for ($i = 1; $i <= 10; $i++) :?>
        <tr>
            <td> <?= $numero ?> X <?= $i ?></td><td> <?= $tabla[$i-1] ?> </td>
        </tr>
        <?php endfor;?>
    </table>
</body>
</html>