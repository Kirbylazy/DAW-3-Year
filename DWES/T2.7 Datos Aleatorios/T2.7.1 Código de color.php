<?php

// Ejercicio 1 - Código de color
// Escriba un programa que cada vez que se ejecute muestre un código de color RGB elegido
// al azar. Un código de color puede tener el formato rgb(rojo, verde, azul), donde rojo, verde y
// azul son números enteros entre 0 y 255.

//Damos un valor aleatorio a cada color

$rojo = mt_rand(0, 255);
$verde = mt_rand(0, 255);
$azul = mt_rand(0, 255);

?>

<!-- Creamos el html para mostrar el resultado -->

<!DOCTYPE html>
<html>
<head>
    <style>

        /* Usamos una hoja de estilo y css para pintar toda la pagina del color obtenido */
        
            body {
            background-color: rgb(<?php echo "$rojo, $verde, $azul"; ?>);
            margin: 0;
        }
    </style>
</head>
<body>

</body>
</html>