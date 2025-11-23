<?php

// Ejercicio 5 - Eliminar dado

// Escriba un programa:

// Que muestre primero una tirada de un número de dados al azar (número de tiradas aleatorio: mínimo 1, máximo 10).
// Que muestre a continuación un dado al azar.
// Que muestre de nuevo la tirada inicial, pero habiendo eliminado de la tirada los
// dados que coincidan con el dado suelto (si hay alguno).
// NOTA: A la hora de mostrar los dados utiliza la estructura foreach.

//declaramos las variables que vamos a usar
$dados = [];
$unicas = [];
$dado = 0;

//con el ciclo for asignamos a un numero aleatorio de dados y su valor
for ($i = 0; $i <= mt_rand(1, 10); $i++):

    $dados[$i] = mt_rand(1, 6);

endfor;

?>


<!-- Usamos un HTML para mostrar todo -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dados Repetidas</title>
</head>
<body>
    <h2>Dados</h2> 
    <table border="1" cellpadding="5">
        <tr>
            <th>Dados</th>
            <!-- Usamos un ciclo for para mostrar todas los dados -->
            <?php for ($i = 0; $i <= (count($dados))-1; $i++): ?>
                <th><img src="dados/<?= $dados[$i] ?>.svg" alt="carta" width="100"></th>
            <?php endfor; ?>
        </tr>

        <?php

        $dado = mt_rand(1, 6);// Asignamos el dado a liminar

        //Con el ciclo for eliminamos todas las copias de este dado
        foreach ($dados as $indice => $valor) {
            if ($valor == $dado) {
                unset($dados[$indice]);
            }
        }

        //eliminamos los valores vacios dentro del array
        $dados = array_values($dados);

        ?>

        <tr>
            <th>Dado a eliminar</th><th><img src="dados/<?= $dado ?>.svg" alt="dado" width="100"></th>     
        </tr>

        <tr>
            <th>Dados no coincidentes</th>
            <!-- Usamos un ciclo for para mostrar los dados unicos -->
            <?php for ($i = 0; $i <= (count($dados))-1; $i++): ?>
                <th><img src="dados/<?= $dados[$i] ?>.svg" alt="dado" width="100"></th>
            <?php endfor; ?>
        </tr>
    </table>
</body>
</html>