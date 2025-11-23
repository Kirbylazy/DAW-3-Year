<?php
// Ejercicio 4.

// Escribe otro ejercicio que le asigne una serie de valores a las siguientes variables y muestre el nombre de la variable, 
// el valor y el tipo de datos al que pertenece. A continuación se le deberá forzar el tipo a lo que se indique, 
// y mostrar el tipo nuevo al que pertenece, el nombre de la variable y su valor. Usar las funciones settype y gettype.


// Variable

// Valor

// Tipo nuevo

// $a1

// 347

// double

// $a2

// 2147483647

// double

// $a3

// -2147483647

// double

// $a4

// 23.7678

// integer

// $a5

// 3.1416

// integer

// $a6

// "347"

// double

// $a7

// "3.1416"

// integer

// $a8

// "Solo literal"

// double

// $a9

// "12.3 Literal con número"

// integer

$Valores = [347,2147483647,-2147483647,23.7678,3.1416,"347","3.1416","Solo literal","12.3 Literal con número",1988];
$tipos = ["double","double","double","integer","integer","double","integer","double","integer","integer"];

foreach (range(1, 10, 1) as $i) {
    ${"a$i"} = $Valores[$i - 1];
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Variables</title>
</head>
<body>
    <h2>Varibles Originales</h2>
    <table border="1">
        <tr>
            <th> Variable </th><th> Contenido </th><th> Tipo </th>
        </tr>
        <?php for ($i = 1; $i <= 10; $i++) :
        $var = ${"a$i"}; 
        $nom = "a$i";
        $tip = gettype($var);
        ?>
        <tr>
            <td> <?= $nom ?> </td><td> <?= $var ?> </td><td> <?= $tip ?> </td>
        </tr>
        <?php endfor;?>
    </table>
    <h2>Varibles Cambiadas</h2>
    <table border="1">
        <tr>
            <th> Variable </th><th> Contenido </th><th> Tipo </th>
        </tr>
        <?php for ($i = 1; $i <= 10; $i++) :
        settype(${"a$i"}, $tipos[$i - 1]);
        $var = ${"a$i"}; 
        $nom = "a$i";
        $tip = gettype($var);
        ?>
        <tr>
            <td> <?= $nom ?> </td><td> <?= $var ?> </td><td> <?= $tip ?> </td>
        </tr>
        <?php endfor;?>
    </table>

</body>
</html>