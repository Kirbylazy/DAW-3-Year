<?php

// Ejercicio 1 - Gestos de manos
// Escriba un programa que muestre un emoji de un gesto de manos al azar, con diferentes tonos de piel. Las entidades numéricas para 
// los distintos emoji son: 

// 128070, 128071, 128072, 128073, 128074, 128075, 128076, 128077, 128078, 128079, 128080, 128133, 
// 128170, 128400, 128405, 128406, 128588, 128591, 129295, 129304, 129305, 129306, 129307, 129308, 
// 129310, 129311, 129330.

// Los tonos de color de piel se consiguen con los modificadores Fitzpatrick

// &#127995; &#127996; &#127997; &#127998; y &#127999;

// Hay varias formas de combinar los modificadores Fitzpatrick con emojis. En este ejercicio aparecen las secuencias más simples, 
// en las que el modificador se escribe a continuación del carácter del emoji. Ejemplo: 

// echo "<p><span style=\"font-size: 8em\">&#númeroEmoji;&#númeroPiel</span></p>";


//Creamos un array con los emoticonos indicados
$manos = [128070, 128071, 128072, 128073, 128074, 128075, 128076, 128077, 128078, 128079, 128080, 128133, 
            128170, 128400, 128405, 128406, 128588, 128591, 129295, 129304, 129305, 129306, 129307, 129308, 
            129310, 129311, 129330];

$eleccion = $manos[mt_rand(0, count($manos)-1)]; //Seleccionamos uno al azar

$color = [127995,127996,127997,127998,127999]; //Creamos un array con todos los colores indicados

$elegido = $color[mt_rand(0, count($color)-1)]; //elegimos uno al azar

?>
<!-- Usamos un HTML para imprimir por pantalla todo lo que necesitamos -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Emoticonos</title>
</head>
<body>
     <h3>Emoticono sin modificar</h3> 
        <p style="font-size: 100px;">&#<?= $eleccion ?><br><p>
    <h3>Emoticono modificado</h3> 
        <p><span style="font-size: 100px">&#<?= $eleccion ?>;&#<? $elegido ?></span></p>
</body>
</html>