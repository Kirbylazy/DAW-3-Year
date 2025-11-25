<?php

function inicializarJugadores($cantidad) : array{

    $jugadores = [];

    foreach (range(1,$cantidad) as $n) {
        $c = 1;
        $jugadores [] = ["nombre" => "Jugador".$c, "activo" => true];
        $c++;
    }
    return $jugadores;

}

function contarActivos($jugadores) {
    $cont = 0;

    foreach ($jugadores as $jugador) {
        if($jugador["activo"]){
            $cont++;
        }
    }

    return $cont;

}

function crearBaraja() :array {
    $palos = ['Oros', 'Copas', 'Espadas', 'Bastos'];
    $baraja = [];

    foreach ($palos as $palo) {
        $baraja [] = ["palo" => $palo, "valor" => "1"];
        $baraja [] = ["palo" => $palo, "valor" => "2"];
        $baraja [] = ["palo" => $palo, "valor" => "3"];
        $baraja [] = ["palo" => $palo, "valor" => "4"];
        $baraja [] = ["palo" => $palo, "valor" => "5"];
        $baraja [] = ["palo" => $palo, "valor" => "6"];
        $baraja [] = ["palo" => $palo, "valor" => "7"];
        $baraja [] = ["palo" => $palo, "valor" => "zota"];
        $baraja [] = ["palo" => $palo, "valor" => "caballo"];
        $baraja [] = ["palo" => $palo, "valor" => "rey"];
    }
    
    
    // Se implementa la baraja completa

    return $baraja;
}

function siguienteActivo($jugadores, $actual) {

    $activo = $actual;

    if ($actual < count($jugadores)-1){
        $activo++;
    }elseif ($actual == count($jugadores)-1){
        $activo = 0;
    }

    return $activo;

}

// print_r(crearBaraja());

$jugadores = inicializarJugadores(4);
//print_r($jugadores);

//echo contarActivos($jugadores);

$jugador = count($jugadores)-1;

$jugador = siguienteActivo($jugadores,$jugador);
echo $jugador;
$jugador = siguienteActivo($jugadores,$jugador);
echo $jugador;
$jugador = siguienteActivo($jugadores,$jugador);
echo $jugador;
$jugador = siguienteActivo($jugadores,$jugador);
echo $jugador;
$jugador = siguienteActivo($jugadores,$jugador);
echo $jugador;

?>