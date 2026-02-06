<?php 

// Comprobamos si existe el archivo de datos, si no, lo creamos
define("ARCHIVO", "biblioteca.dat");
if (!file_exists(ARCHIVO)) {
    file_put_contents(ARCHIVO, serialize([]));
}

// Función para guardar materiales en el archivo
function guardarMateriales($materiales) {
    file_put_contents(ARCHIVO, serialize($materiales));
}

// Función para leer materiales desde el archivo
function leerMateriales() {
    return unserialize(file_get_contents(ARCHIVO));
}

// Función para añadir materiales
function anadirMaterial($material) {
    $materiales = leerMateriales();
    $materiales[] = $material;
    guardarMateriales($materiales);
}

// Función para cambiar disponibilidad
function cambiarDisponibilidad($identificador) {
    $materiales = leerMateriales();
    foreach ($materiales as &$material) {
        if ($material->identificador == $identificador) {
            $material->disponible = !$material->disponible;
            break;
        }
    }
    guardarMateriales($materiales);
}

// Función para borrar un material
function borrarMaterial($identificador) {
    $materiales = leerMateriales();
    foreach ($materiales as $key => $material) {
        if ($material->identificador == $identificador) {
            unset($materiales[$key]);
            break;
        }
    }
    // Reindexar el array después de borrar
    $materiales = array_values($materiales);
    guardarMateriales($materiales);
}

// Gestión de cookies
function registrarVisita($titulo) {
    setcookie("ultimo_material", $titulo, time() + 5); 
    setcookie("ultima_visita", date("d-m-Y H:i:s"), time() + 5);
    header("Refresh: 0");
}

// Mensaje de cookies
function obtenerMensaje() {
    $mensaje = "Sin consultas en los últimos 5 segundos.";
    
    if (isset($_COOKIE["ultima_visita"])) {
        $mensaje = "Última visita: " . $_COOKIE["ultima_visita"];
        
        if (isset($_COOKIE["ultimo_material"])) {
            $mensaje .= " | Último material: " . $_COOKIE["ultimo_material"];
        }
    }
    
    return $mensaje;
}
?>