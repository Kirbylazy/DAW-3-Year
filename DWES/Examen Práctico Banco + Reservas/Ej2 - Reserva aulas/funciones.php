<?php

// Función de conexión a la base de datos
function conectarBD()
{

}

function desconectar($conex)
{

}

// Función para registrar un nuevo profesor
function registrarProfesor($nombre, $email, $password): bool
{

    // Comprobar si el email ya existe
    $stmt = $pdo->prepare("SELECT id FROM profesores WHERE email = :email");


    // Insertar el nuevo profesor
    $stmt = $pdo->prepare("INSERT INTO profesores (nombre, email, password) VALUES (:nombre, :email, :password)");
  

}

// Iniciar sesión del profesor
function iniciarSesion($email, $password): bool
{
    $stmt = $pdo->prepare("SELECT * FROM profesores WHERE email = :email");

}

// Función para comprobar si un aula está disponible
function comprobarDisponibilidad($aula_id): bool
{

    $sql = "SELECT * FROM reservas WHERE aula_id = :aula_id AND reservada = TRUE";

    // Si hay resultados, significa que el aula ya está reservada
    // Si no hay resultados, está libre

}

// Crear nueva reserva
function crearReserva($profesor_id, $aula_id, $fecha, $motivo): bool
{
    $pdo = conectarBD();
    // Comprobar disponibilidad, usando la función anterior

    // Si el aula está libre, hago la reserva
        $stmt = $pdo->prepare("INSERT INTO reservas (profesor_id, aula_id, fecha, motivo) VALUES (:profesor_id, :aula_id, :fecha, :motivo)");

}

// Eliminar reserva
function eliminarReserva($reserva_id, $profesor_id): bool
{

    $stmt = $pdo->prepare("DELETE FROM reservas WHERE id = :reserva_id AND profesor_id = :profesor_id");

}

// Obtener reservas del profesor actual
function obtenerReservas($profesor_id)
{

    $stmt = $pdo->prepare("SELECT r.*, a.nombre as aula_nombre 
                             FROM reservas r JOIN aulas a ON r.aula_id = a.id 
                            WHERE r.profesor_id = :profesor_id 
                            ORDER BY r.fecha DESC");

}

// OBTENER AULAS LIBRES
function obtenerAulas()
{

    $sql = "SELECT a.* FROM aulas a 
             WHERE a.id NOT IN (SELECT DISTINCT r.aula_id 
                                  FROM reservas r 
                                 WHERE r.reservada = TRUE) 
             ORDER BY a.nombre";

}

// Cambiar estado de reserva (de activa a terminada)
function cambiarEstadoReserva($reserva_id, $profesor_id)
{
    //SI NO HAY RESERVA, NO TIENE FILAS EN LA TABLA RESERVAS
    // SI TIENE UNA FILA CON "RESERVADA" VALOR 1, ESTÁ RESERVADA
    // SI TIENE UNA FILA CON "RESERVADA" VALOR 0, ESTÁ TERMINADA

    // Obtener estado actual
    $stmt = $pdo->prepare("SELECT reservada FROM reservas WHERE id = :reserva_id AND profesor_id = :profesor_id");

    // Actualizar desde reservada (reservada = 1), a terminada (reservada = 0)
    $stmt = $pdo->prepare("UPDATE reservas SET reservada = :reservada WHERE id = :reserva_id AND profesor_id = :profesor_id");

}
