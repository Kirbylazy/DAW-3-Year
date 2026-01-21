<?php
include_once('parametros.php');
// Función de conexión a la base de datos
function conectarBD()
{
    try {
        // Crear la conexión PDO
        $conexion = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establecer manejo de errores
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit();
    }

    return $conexion;
}

function desconectar(&$conex)
{
    $conex = null;
}

// Función para registrar un nuevo profesor
function registrarProfesor($nombre, $email, $password): bool
{
    $pdo = conectarBD();
    // Comprobar si el email ya existe
    $stmt = $pdo->prepare("SELECT id FROM profesores WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $existe = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($existe)){

        return false;

    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo profesor
    $stmt = $pdo->prepare("INSERT INTO profesores (nombre, email, password) 
                                VALUES (:nombre, :email, :password)");
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hash, PDO::PARAM_STR);
    $stmt->execute();

    desconectar($pdo);

    return true;

}

// Iniciar sesión del profesor
function iniciarSesion($email, $password): bool
{
    $pdo = conectarBD();

    $stmt = $pdo->prepare("SELECT * FROM profesores WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($usuario)){

        if (password_verify($password, $usuario['password'])){

            return true;

        }else{

            return false;

        }
    }else{

        return false;
        
    }
    
}

// Función para comprobar si un aula está disponible
function comprobarDisponibilidad($aula_id): bool
{
    $pdo = conectarBD();

    $sql = "SELECT * FROM reservas WHERE aula_id = :aula_id AND reservada = TRUE";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['aula_id' => $aula_id]);
    $aulas = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!empty($aulas)){
    // Si hay resultados, significa que el aula ya está reservada

        return false;

    }else{
    // Si no hay resultados, está libre
        return true;
    }

}

// Crear nueva reserva
function crearReserva($profesor_id, $aula_id, $fecha, $motivo): bool
{
    $pdo = conectarBD();
    // Comprobar disponibilidad, usando la función anterior

    if (comprobarDisponibilidad($aula_id)){

        // Si el aula está libre, hago la reserva
        $stmt = $pdo->prepare("INSERT INTO reservas (profesor_id, aula_id, fecha, motivo) 
                                VALUES (:profesor_id, :aula_id, :fecha, :motivo)");
        $stmt->execute(['profesor_id' => $profesor_id, 
                        'aula_id' => $aula_id, 
                        'fecha' => $fecha, 
                        'motivo' => $motivo]);

        return true;

    }else{

        return false;
    }
}

// Eliminar reserva
function eliminarReserva($reserva_id, $profesor_id): bool
{
    $pdo = conectarBD();

    $stmt = $pdo->prepare("DELETE FROM reservas WHERE id = :reserva_id 
                            AND profesor_id = :profesor_id");
    $stmt->execute(['reserva_id' => $reserva_id, 
                    'profesor_id'=> $profesor_id]);

    return $stmt->rowCount() > 0;

}

// Obtener reservas del profesor actual
function obtenerReservas($profesor_id)
{
    $pdo = conectarBD();
    $stmt = $pdo->prepare("SELECT r.*, a.nombre as aula_nombre 
                             FROM reservas r JOIN aulas a ON r.aula_id = a.id 
                            WHERE r.profesor_id = :profesor_id 
                            ORDER BY r.fecha DESC");
    $stmt->execute(['profesor_id' => $profesor_id]);
    $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $reservas;

}

// OBTENER AULAS LIBRES
function obtenerAulas()
{
    $pdo = conectarBD();
    $sql = "SELECT a.* FROM aulas a 
             WHERE a.id NOT IN (SELECT DISTINCT r.aula_id 
                                  FROM reservas r 
                                 WHERE r.reservada = TRUE) 
             ORDER BY a.nombre";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $aulas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $aulas;

}

// Cambiar estado de reserva (de activa a terminada)
function cambiarEstadoReserva($reserva_id, $profesor_id)
{
    //SI NO HAY RESERVA, NO TIENE FILAS EN LA TABLA RESERVAS
    // SI TIENE UNA FILA CON "RESERVADA" VALOR 1, ESTÁ RESERVADA
    // SI TIENE UNA FILA CON "RESERVADA" VALOR 0, ESTÁ TERMINADA
    $pdo = conectarBD();
    // Obtener estado actual
    $stmt = $pdo->prepare("SELECT reservada FROM reservas WHERE id = :reserva_id 
                            AND profesor_id = :profesor_id");
    $stmt->execute(['reserva_id' => $reserva_id, 'profesor_id' => $profesor_id]);
    $reserva = $stmt->fetch(PDO::FETCH_ASSOC);

    if(empty($reserva)){

        return false;

    }

    $estado = $reserva['reservada'];
    
    if($estado == 1){

        // Actualizar desde reservada (reservada = 1), a terminada (reservada = 0)
        $stmt = $pdo->prepare("UPDATE reservas SET reservada = 0 
                                WHERE id = :reserva_id AND profesor_id = :profesor_id");
        $stmt->execute(['reserva_id' => $reserva_id, 'profesor_id' => $profesor_id]);

        return true;

    }elseif($estado == 0){

        return false;
    }

}
