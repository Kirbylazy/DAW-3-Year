<?php
require_once 'clases.php';


// Función para leer movimientos de un usuario específico
function leerMovimientos($dni) {

    $archivo = $dni . ".txt";

    if(!file_exists($archivo)){

        return [];
    }

    $datos = file_get_contents($archivo);

    if (empty($datos)){

        return [];
    }

    $movimientos = unserialize($datos);

    return $movimientos;

}

// Función para guardar todos los movimientos de un usuario
function guardarMovimientos($dni, $movimientos) {

    $archivo = $dni . ".txt";

    file_put_contents($archivo, serialize($movimientos));

}

// Función para añadir un nuevo movimiento
function anadirMovimiento($dni, $movimiento) {

    $movimientos = leerMovimientos($dni);
    $movimientos [] = $movimiento;
    guardarMovimientos($dni, $movimientos);

}

?>