<?php

// Ejercicio 4 - Ciudades
// Escriba un array de ocho ciudades de España. Elimina al azar una de ellas y muestra el
// nuevo array de ciudades.


//Creamos las variables necesarias

$ciudades = ["Sevilla", "Huelva", "Cadiz", "Malaga", "Granada", "Almeria", "Jaen", "Cordoba"];//Las 8 ciudades

$numero = mt_rand(0, 7);//Elegimos una posición a eliminar

$ciudades7 = $ciudades;//hacemos una copia del array original para modificar

unset ($ciudades7 [$numero]);//eliminamos la posición elegida

$ciudades7 = array_values($ciudades7);//Comprimimos el array para que no nos de errores

?>

<!-- Creamos el HTML conde mostrar las ciudades -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ciudades</title>
</head>
<body>
    <!--Construimos la tabla con un for usando el array -->
     <h2>Ciudades</h2> 
    <table border="1">
        <tr>
            <th> 8 Ciudades </th><th> 7 Ciudades </th>
        </tr>
        <?php for ($i = 1; $i <= 7; $i++) :?>
        <tr>
            <td> <?= $ciudades[$i-1] ?> </td><td> <?= $ciudades7[$i-1] ?> </td>
        </tr>
        <?php endfor;?>
    <!-- Sacamos la ultima linea a parte ya que el segun array solo una posición menos y nos daria error -->
        <tr>
            <td> <?= $ciudades[7] ?> </td><td>  </td>
        </tr>
    </table>
</body>
</html>