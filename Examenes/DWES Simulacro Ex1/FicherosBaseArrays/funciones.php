<?php
/**
 * FUNCIONES.PHP
 * Todas las funciones del juego El Reloj
 * Implementadas con funciones de arrays
 */

/**
 * Función para crear una baraja española (40 cartas)
 * Puedes usar range() y array_merge() 
 * 
 * @return array Baraja completa con 40 cartas
 */
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

/**
 * Función para obtener la secuencia de enunciación
 * Puedes usar array_merge() y range()
 * 
 * @return array Secuencia: [1,2,3,4,5,6,7,Sota,Caballo,Rey]
 */
function obtenerSecuencia() :array {

    $secuencia = [1,2,3,4,5,6,7,"zota","caballo","rey"];

    return $secuencia;

}

/**
 * Función para inicializar los jugadores
 * Usa range() 
 * 
 * @param int $cantidad Número de jugadores
 * @return array Array de jugadores con estructura [nombre, activo]
 */
function inicializarJugadores($cantidad) : array{

    $jugadores = [];

    foreach (range(1,$cantidad) as $n) {
        $jugadores [] = ["nombre" => "Jugador".$n, "activo" => true];
    }
    return $jugadores;

}

/**
 * Función para contar jugadores activos
 * 
 * @param array $jugadores Array de jugadores
 * @return int Cantidad de jugadores activos
 */
function contarActivos($jugadores) {
    $cont = 0;

    foreach ($jugadores as $jugador) {
        if($jugador["activo"]){
            $cont++;
        }
    }

    return $cont;

}

/**
 * Función para obtener el índice del siguiente jugador activo
 * Usa count() del documento
 * 
 * @param array $jugadores Array de jugadores
 * @param int $actual Índice del jugador actual
 * @return int Índice del siguiente jugador activo
 */
function siguienteActivo($jugadores, $actual) {

    $total = count($jugadores);

    // Si ya no hay jugadores o queda solo 1
    if ($total <= 1) return 0;

    // Avanzar al siguiente índice
    $actual++;

    // Si se sale del array, volver al principio
    if ($actual >= $total) {
        $actual = 0;
    }

    return $actual;

}

/**
 * Función para obtener los ganadores (los que siguen activos)
 * 
 * @param array $jugadores Array de jugadores
 * @return array Array con los nombres de los ganadores
 */
function obtenerGanadores($jugadores) : array{
    $ganadores = $jugadores;
    foreach ($ganadores as $indice => $jugador) {
        if ($jugador["activo"] == false){
            unset($ganadores[$indice]);
        }
    }

    return $ganadores;
}

/**
 * Función principal que ejecuta el juego completo
 * Se juega hasta que se vacíe la baraja
 * 
 * @param int $numJugadores Número de jugadores
 * @return array Array con el historial y los ganadores
 */
function jugarPartida($numJugadores) {
    // Crear y barajar la baraja
    $baraja = crearBaraja();

    // Mezclar cartas
    shuffle($baraja);


    
    // Obtener la secuencia de enunciación
    
    // Inicializar jugadores

    $jugadores = inicializarJugadores($numJugadores);
    $jugadoresActivos = $jugadores;
        
    // Array para almacenar el historial de jugadas

    $mensaje = [];
    $jugador = count($jugadores)-1;
    $secuencia = obtenerSecuencia();
    $carta = 0;

        for ($i=0; $i < 4; $i++):

            if (contarActivos($jugadoresActivos) <= 1){
                    break;
                }

            foreach ($secuencia as $valor):
                $jugador = siguienteActivo($jugadoresActivos,$jugador);
                if($baraja[$carta]["valor"] == $valor){

                    $mensaje [] = "Turno " . ($carta+1) . ": " . $jugadoresActivos[$jugador]["nombre"].
                                " saca la carta: Palo - " . $baraja[$carta]["palo"].
                                ", Valor - " . $baraja[$carta]["valor"] . "<strong> ELIMINADO</strong>";

                    unset($jugadoresActivos[$jugador]);
                    $jugadoresActivos = array_values($jugadoresActivos);
                    $jugadores[$jugador]["activo"]=false;

                }else{
                    $mensaje [] = "Turno " . ($carta+1) . ": " . $jugadoresActivos[$jugador]["nombre"].
                                    " saca la carta: Palo - " . $baraja[$carta]["palo"].
                                    ", Valor - " . $baraja[$carta]["valor"] . " Se salva";
                }

                if (contarActivos($jugadoresActivos) <= 1){
                    break;
                }

                $carta++;
            endforeach;
        endfor;
        
    return $mensaje;
    // Jugar hasta que se acaben las cartas o quede solo un jugador

        // Si el jugador actual no está activo, buscar el siguiente
        
        // Obtener el valor enunciado
        
        // Verificar si hay coincidencia (eliminación)
        
        // Actualizar estado del jugador
        
        // Registrar la jugada 
        
        // Avanzar al siguiente jugador activo
        
        // Avanzar en la secuencia (ciclar cuando llegue al final)
    
    
    // Obtener ganadores (pueden ser varios si hay empate)
    
    // Retornar resultados al index

}

?>