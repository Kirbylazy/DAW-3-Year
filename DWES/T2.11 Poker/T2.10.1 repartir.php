<?php

// Repartir asignará un jugador por cada $numJug asignado y le repartira 5 cartas del mazo de cartas a cada jugador

$baraja = [
        "C" => [2,3,4,5,6,7,8,9,10,11,12,13,14],
        "D" => [2,3,4,5,6,7,8,9,10,11,12,13,14],
        "H" => [2,3,4,5,6,7,8,9,10,11,12,13,14],
        "S" => [2,3,4,5,6,7,8,9,10,11,12,13,14],
    ];

function repartir($numJug) {

    global $baraja;

    for ($i = 0; $i < $numJug; $i++) {
        $juego[$i] = [];
        for ($j = 0; $j < 5; $j++) {
            $palo = array_rand($baraja);
            $valor = $baraja[$palo][array_rand($baraja[$palo])];

            $juego[$i][] = [
                "palo" => $palo,
                "valor" => $valor];

            unset($baraja[$palo][array_search($valor, $baraja[$palo])]);
            
        }
    }

    return $juego;
}

function descartar($juego,$d1,$d2) {

    global $baraja;

            unset($juego[1][$d1-1]);
            unset($juego[1][$d2-1]);

            $paloc1 = $baraja[array_rand($baraja)];
            $valorc1 = $baraja[$paloc1][array_rand($baraja[$paloc1])];
            $c1 = [
                "palo" => $paloc1,
                "valor" => $valorc1];

            $paloc2 = $baraja[array_rand($baraja)];
            $valorc2 = $baraja[$paloc2][array_rand($baraja[$paloc2])];
            $c2 = [
                "palo" => $paloc2,
                "valor" => $valorc2];

            $juego[1][$d1] = $c1;
            $juego[1][$d2] = $c2;
            
        

    return $juego;

}

?>