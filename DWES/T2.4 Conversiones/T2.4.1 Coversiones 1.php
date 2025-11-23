<?php
// Ejercicio 3
// 
// Realiza un ejercicio que asigne los siguientes valores a variables $a1 a $a10 y 
// después te muestre la variable y el tipo, usando gettype($var).

// 347

// 2147483647

// -2147483647

// 23.7678

// 3.1416

// "347" 

// "3.1416" 

// "Solo literal" 

// "12.3 Literal con número"

// 1988



$Valores = [347,2147483647,-2147483647,23.7678,3.1416,"347","3.1416","Solo literal","12.3 Literal con número",1988];

foreach (range(1, 10, 1) as $i) {
    ${"a$i"} = $Valores[$i - 1];
}

for ($i = 1; $i <= 10; $i++) {
    $var = ${"a$i"};
    echo "$var es de tipo " . gettype($var) . "<br>";
}

?>