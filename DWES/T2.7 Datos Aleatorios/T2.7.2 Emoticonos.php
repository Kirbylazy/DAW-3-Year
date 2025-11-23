<?php

// Ejercicio 2 - Emoticono
// Escriba un programa que cada vez que se ejecute muestre un emoticono elegido al azar
// entre los caracteres Unicode 128512 y 128586.
// Nota: Para mostrar el emoticono en HTML hay que anteponer &# al número


// Obtenemos un numero aleatorio para el emoticono
$emoticono = mt_rand(128512, 128586);

?>
<!-- Usamos HTML para mostrar el emoticono -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Emoticonos</title>
</head>
<body>
     <h2>Emoticono</h2> 
        <h1 style="font-size: 100px;">&#<?= $emoticono ?><h1>
</body>
</html>
