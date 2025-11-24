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

}

/**
 * Función para inicializar los jugadores
 * Usa range() 
 * 
 * @param int $cantidad Número de jugadores
 * @return array Array de jugadores con estructura [nombre, activo]
 */
function inicializarJugadores($cantidad) : array{

}

/**
 * Función para contar jugadores activos
 * 
 * @param array $jugadores Array de jugadores
 * @return int Cantidad de jugadores activos
 */
function contarActivos($jugadores) {

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

}

/**
 * Función para obtener los ganadores (los que siguen activos)
 * 
 * @param array $jugadores Array de jugadores
 * @return array Array con los nombres de los ganadores
 */
function obtenerGanadores($jugadores) : array{

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

    // Mezclar cartas
    
    // Obtener la secuencia de enunciación
    
    // Inicializar jugadores
        
    // Array para almacenar el historial de jugadas

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