<?php

// Ejercicio 3 - Números
// Escriba un programa que muestre un número del cero al 9 al azar y escriba en letras el
// valor obtenido.


//Generamos el numero aleatorio
$numero = mt_rand(0, 9);
$mensaje = "";

//Elegimos el mensaje a mostrar según el numero que hallamos obtenido
switch ($numero) {
    case '1':
        $mensaje = "Uno";
        break;

    case '2':
        $mensaje = "Dos";
        break;

    case '3':
        $mensaje = "Tres";
        break;

    case '4':
        $mensaje = "Cuatro";
        break;

    case '5':
        $mensaje = "Cinco";
        break;

    case '6':
        $mensaje = "Seis";
        break;

    case '7':
        $mensaje = "Siete";
        break;

    case '8':
        $mensaje = "Ocho";
        break;
    
    case '9':
        $mensaje = "Nueve";
        break;

    case '0':
        $mensaje = "Cero";
        break;

    default:
        $mensaje = "Usted ha elegido una opción incorrecta";
        break;
}

?>
<!-- Creamos el HTML para mostrar el mensaje -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Numeros</title>
</head>
<body>
     <h2>Numero</h2> 
        <h1 style="font-size: 100px;"><?= $mensaje ?><h1>
</body>
</html>