<?php
require_once('parametros.php');
// Iniciar sesión y conexión a base de datos
session_start();

function conectar()
{

}

// Función para redirigir a index si no hay sesión
function requerir_login()
{
    // COMPLETAR

}

// Función para obtener la cita más valorada
function obtener_cita_destacada()
{
    //COMPLETAR
    $stmt = $pdo->prepare("
            SELECT c.texto, c.autor, (rp.likes - rp.dislikes) AS puntuacion
            FROM citas c LEFT JOIN resumen_puntuaciones rp ON c.id = rp.cita_id
            ORDER BY puntuacion DESC 
            LIMIT 1
        ");


}

// Función de login
function login_usuario($email, $clave)
{
    // COMPLETAR

    // Si se ha leído de la bbdd, comprobamos la clave.
    if ($usuario && password_verify($clave, $usuario['clave'])) {
        // Si es correcta, guardo info en la sesión y devuelvo true

        return true;
    } else {
        // Si es incorrecta, devuelvo false
        return false;
    }
}

// Función de registro
function registrar_usuario($email, $nombre, $clave)
{
    // COMPLETAR


}

// Función para obtener citas
function obtener_citas(){
        // COMPLETAR

    $stmt = $pdo->prepare("SELECT c.*, u.nombre AS usuario_nombre
            FROM citas c      JOIN usuarios u              ON c.usuario_id = u.id       ");

}

// Función para crear cita
function crear_cita($texto, $autor, $usuario_id)
{
        // COMPLETAR
$stmt = $pdo->prepare("INSERT INTO citas (texto, autor, usuario_id)...";
}

// Función para votar cita
function votar_cita($usuario_id, $cita_id, $puntuacion)
{
$stmt = $pdo->prepare("INSERT INTO puntuaciones (usuario_id, cita_id, puntuacion) 
                                VALUES (:usuario_id, :cita_id, :puntuacion)
                                    ON DUPLICATE KEY UPDATE puntuacion = :puntuacion");
}

// Función para cerrar sesión
function cerrar_sesion()
{

}

// Actualizar puntuacion en bbdd cuando pulsan megusta
function meGusta($usuario_id, $cita_id)
{

}

// Actualizar puntuacion en bbdd cuando pulsan nomegusta
function noMeGusta($usuario_id, $cita_id)
{

}

// Obtiene el total de puntos de una cita
function obtener_puntos_cita($cita_id)
{
    // COMPLETAR
    $stmt = $pdo->prepare("SELECT SUM(puntuacion) as puntuacion
                             FROM puntuaciones
                            WHERE cita_id = :cita_id");
}

// Obtiene los puntos que un usuario ha dado a una cita
function obtener_puntos_cita_usuario($usuario_id, $cita_id)
{
        // COMPLETAR
    $stmt = $pdo->prepare("SELECT puntuacion
                             FROM puntuaciones
                            WHERE cita_id = :cita_id
                              AND usuario_id = :usuario_id");
}
