<?php

// Ejercicio 3 - Números aleatorios en array
// Escribe un programa que genere 6 números aleatorios de 1 al 6 y los guarde en un array.
// Una vez generado el array:

// Mostrar cuántas veces aparece cada uno de los valores, del 1 al 6, en el array
// generado.

// Obtener otro número al azar entre 1 y 6. Con ese número obtenido comprobar si se encuentra en el array generado y 
// en caso de que así sea mostrar todos los índices donde aparezca ese número.

// Mostrar el array original ordenada de mayor a menor.

// Mostrar el array sin valores duplicados y sin huecos en los índices.



$array = []; //Creamos el array con el que vamos a trabajar

//Usamos un ciclo for para crear todas las instancias del array

for ($i = 1; $i <= 6; $i++) :

    $array [$i-1]= mt_rand(1, 6);

endfor;

print_r($array); //Imprimimos el array para tenerlo como referencia

echo "<br><br>";

$repeticiones = array_count_values($array); //usamos Esra función para crear una herramienta para comprobar el numero de copias

//Usamos el ciclo for para comprobar todos los numeros del 1 al 6

for ($i = 1; $i <= 6; $i++) :

    $veces = isset($repeticiones[$i]) ? $repeticiones[$i] : 0;

    Echo "El número $i aparece $veces veces<br>";

endfor;

echo "<br><br>";

$buscar = mt_rand(1, 6); //Creamos el umero que usaremos para buscar en nuestra array

echo "El numero a buscar es $buscar"; //Lo imprimimos para comprobar

echo "<br><br>";

//usamos el if para comprobar que el numero buscado está en nuestro array

if (in_array($buscar, $array)) {

    echo "El número $buscar está en el array<br><br>"; //En caso de que lo encuentre nos lo comunica

    // Y con el foreach, por cada instacia del array, comprobamos si esta el numero que buscamos

    foreach ($array as $indice => $valor) {

        if ($valor == $buscar) {

            $posiciones[] = $indice; // Si lo encuentra, lo guarda en este Array
        }
    }

    //Imprimimos por pantalla las posiciones donde hay coincidencia
    echo "El número $buscar está en las posiciones: " . implode(", ", $posiciones); 

} else {

    //En el caso de no encontrar coincidencia lo comunicamos

    echo "El número $buscar NO está en el array";
}

echo "<br><br>";
echo "Array Ordenado";
echo "<br><br>";

$orden = $array; //Copiamos nuestro array para no modificar el original
rsort($orden); //Ordenamos el nuevo array

print_r($orden);//Lo mostramos

echo "<br><br>";
echo "Array sin repetidos";
echo "<br><br>";

$unicos = array_unique($array);//Creamos un nuevo array con los valores sin repetir

$unicos = array_values($unicos);//Quitamos tadas las posiciones vacias

print_r($unicos); //Imprimimos el resultado