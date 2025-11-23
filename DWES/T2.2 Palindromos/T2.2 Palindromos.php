<?php

// Crea variables con palabras y verifica si son palíndromos (se leen igual al revés). 
// Utiliza alguna función que te ayude a realizar el ejercicio en la página oficial de PHP.

// He usado una función para hacer este ejercicio aprovechando que hoy hemos aprendido a usarlas

// Variables con palabras
$palabra1 = "ana";
$palabra2 = "oso";
$palabra3 = "casa";
$palabra4 = "reconocer";

// Función para verificar si una palabra es palíndromo
function esPalindromo($palabra) {
    // Convertimos todo a minúsculas para evitar errores por mayúsculas o minúsculas
    $palabra = strtolower($palabra);
    // Comparamos la palabra con su versión invertida usando strrev()
    return $palabra === strrev($palabra);
}

// Probamos las palabras
$palabras = [$palabra1, $palabra2, $palabra3, $palabra4];

foreach ($palabras as $palabra) {
    if (esPalindromo($palabra)) {
        echo "$palabra es un palíndromo.<br>";
    } else {
        echo "$palabra NO es un palíndromo.<br>";
    }
}
?>