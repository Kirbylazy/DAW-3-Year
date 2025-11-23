<?php

// Ejercicio 2 - Tabla de alumnos con su edad
// Dadas las siguientes tablas con nombre y edad de los alumnos de dos clases diferentes:

// Crea dos arrays independientes para guardar los datos de cada una de las tablas
// anteriores y muestra por pantalla la información de ambas.

// A continuación une ambas tablas en una sóla y muestra los datos de esta nueva
// tabla.



// Creamos los dos arrays que nos pide el ejercicio

$primero = [
    [
        "nombre" => "Juan",
        "edad" => 21
    ],
    [
        "nombre" => "María",
        "edad" => 19
    ],
    [
        "nombre" => "Pedro",
        "edad" => 24
    ],
    [
        "nombre" => "Antonio",
        "edad" => 30
    ],
    [
        "nombre" => "Carmen",
        "edad" => 24
    ],
    [
        "nombre" => "Carlos",
        "edad" => 26
    ],
    [
        "nombre" => "Lucía",
        "edad" => 22
    ]

];

$segundo = [
    [
        "nombre" => "Jaime",
        "edad" => 27
    ],
    [
        "nombre" => "Luisa",
        "edad" => 21
    ],
    [
        "nombre" => "Aitor",
        "edad" => 33
    ],
    [
        "nombre" => "Macarena",
        "edad" => 22
    ],
    [
        "nombre" => "Maria",
        "edad" => 27
    ],
    [
        "nombre" => "Pedro",
        "edad" => 28
    ],
    [
        "nombre" => "Juan",
        "edad" => 24
    ]

];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clases</title>
</head>
<body>
     <h2>Clase de Primero</h2> <!--Construimos la tabla con un for usando la primera array -->
    <table border="1">
        <tr>
            <th> Nombre </th><th> Edad </th>
        </tr>
        <?php for ($i = 1; $i <= count($primero); $i++) :?>
        <tr>
            <td> <?= $primero[$i-1]["nombre"] ?> </td><td> <?= $primero[$i-1]["edad"] ?> </td>
        </tr>
        <?php endfor;?>
    </table>

    <h2>Clase de Segundo</h2> <!--Construimos la tabla con un for usando la segunda array -->
    <table border="1">
        <tr>
            <th> Nombre </th><th> Edad </th>
        </tr>
        <?php for ($i = 1; $i <= count($segundo); $i++) :?>
        <tr>
            <td> <?= $segundo[$i-1]["nombre"] ?> </td><td> <?= $segundo[$i-1]["edad"] ?> </td>
        </tr>
        <?php endfor;?>
    </table>

    <?php
    $todos = array_merge($primero, $segundo); //Fusionamos las dos arrays
    ?>

    </table>
    <h2>Clases Fusionadas</h2> <!--Construimos la tabla con un for usando el array fusionado -->
    <table border="1">
        <tr>
            <th> Nombre </th><th> Edad </th>
        </tr>
        <?php for ($i = 1; $i <= count($todos); $i++) :?>
        <tr>
            <td> <?= $todos[$i-1]["nombre"] ?> </td><td> <?= $todos[$i-1]["edad"] ?> </td>
        </tr>
        <?php endfor;?>
    </table>

</body>
</html>