<?php

// Ejercicio 4 - Eliminar valores repetidos

// Escriba un programa:

// Que muestre primero un grupo de entre 5 y 15 cartas de corazones numeradas del 1
// al 10 al azar (carpeta cartas).
// Que muestre de nuevo el grupo inicial, pero habiendo eliminado del grupo los valores
// repetidos.

//declaramos las variables que vsamos a usar
$cartas = [];
$unicas = [];

//con el ciclo for asignamos a un numero aleatorio de cartas su valor
for ($i = 0; $i <= mt_rand(5, 15); $i++):

    $cartas[$i] = mt_rand(1, 10);

endfor;

//Eliminamos las copias y los huecos vacios del array
$unicas = array_values(array_unique($cartas));

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
            <th>Cartas</th>
            <!-- Usamos un ciclo for para mostrar todas las cartas -->
            <?php for ($i = 0; $i <= (count($cartas))-1; $i++): ?>
                <th><img src="cartas/c<?= $cartas[$i] ?>.svg" alt="carta" width="100"></th>
            <?php endfor; ?>
        </tr>
        <tr>
            <th>Cartas Unicas</th>
            <!-- Usamos un ciclo for para mostrar las cartas unicas -->
            <?php for ($i = 0; $i <= (count($unicas))-1; $i++): ?>
                <th><img src="cartas/c<?= $unicas[$i] ?>.svg" alt="carta" width="100"></th>
            <?php endfor; ?>
        </tr>
    </table>
</body>
</html>