<?php
include_once('parametros.php');

/**
 * NOTA:
 * session_start() debe llamarse en los controladores (index.php, principal.php, registro.php)
 * antes de cualquier salida HTML. No aquí, para evitar "headers already sent".
 */

// Función de conexión a la base de datos
function conectarBD(): PDO
{
    try {
        $conexion = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
            DB_USER,
            DB_PASS
        );
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;

    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit();
    }
}

function desconectar(&$conex): void
{
    $conex = null;
}

// Función para registrar un nuevo paciente
function registrarPaciente($nombre, $email, $clave): bool
{
    $pdo = conectarBD();

    // Comprobar si el email ya existe
    $stmt = $pdo->prepare("SELECT id FROM pacientes WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $existe = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($existe)) {
        desconectar($pdo);
        return false;
    }

    // Cifrar contraseña
    $hash = password_hash($clave, PASSWORD_DEFAULT);

    // Insertar el nuevo paciente
    $stmt = $pdo->prepare(
        "INSERT INTO pacientes (nombre, email, clave) VALUES (:nombre, :email, :clave)"
    );
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':clave', $hash, PDO::PARAM_STR);
    $stmt->execute();

    desconectar($pdo);
    return true;
}

// Iniciar sesión del paciente
function iniciarSesion($email, $clave): bool
{
    $pdo = conectarBD();

    $stmt = $pdo->prepare("SELECT * FROM pacientes WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $paciente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($paciente)) {
        $_SESSION['mensaje'] = "Paciente no registrado";
        desconectar($pdo);
        return false;
    }

    if (!password_verify($clave, $paciente['clave'])) {
        $_SESSION['mensaje'] = "Clave incorrecta";
        desconectar($pdo);
        return false;
    }

    // Guardar datos en la sesión
    $_SESSION['id'] = $paciente['id'];
    $_SESSION['nombre'] = $paciente['nombre'];
    $_SESSION['mensaje'] = "Sesión iniciada correctamente";

    desconectar($pdo);
    return true;
}

// Función para comprobar si un médico está disponible
function comprobarDisponibilidad($medico_id, $fecha): bool
{
    $pdo = conectarBD();

    $sql = "SELECT id FROM citas
            WHERE medico_id = :medico_id AND fecha = :fecha AND activa = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'medico_id' => $medico_id,
        'fecha'     => $fecha
    ]);

    $ocupado = $stmt->fetch(PDO::FETCH_ASSOC);

    desconectar($pdo);

    // Si hay resultado => está ocupado
    return empty($ocupado);
}

// Crear nueva cita
function crearCita($paciente_id, $medico_id, $fecha, $motivo): bool
{
    // Comprobar disponibilidad (sin pisar mensajes)
    if (!comprobarDisponibilidad($medico_id, $fecha)) {
        $_SESSION['mensaje'] = "El médico no está disponible en esa fecha";
        return false;
    }

    $pdo = conectarBD();

    $stmt = $pdo->prepare(
        "INSERT INTO citas (paciente_id, medico_id, fecha, motivo)
         VALUES (:paciente_id, :medico_id, :fecha, :motivo)"
    );
    $stmt->execute([
        'paciente_id' => $paciente_id,
        'medico_id'   => $medico_id,
        'fecha'       => $fecha,
        'motivo'      => $motivo
    ]);

    desconectar($pdo);

    $_SESSION['mensaje'] = "Cita creada correctamente";
    return true;
}

// Cancelar cita
function cancelarCita($cita_id, $paciente_id): bool
{
    $pdo = conectarBD();

    $stmt = $pdo->prepare(
        "DELETE FROM citas WHERE id = :cita_id AND paciente_id = :paciente_id"
    );
    $stmt->execute([
        'cita_id'     => $cita_id,
        'paciente_id' => $paciente_id
    ]);

    $ok = ($stmt->rowCount() > 0);
    desconectar($pdo);

    if ($ok) {
        $_SESSION['mensaje'] = "Cita cancelada correctamente";
        return true;
    }

    $_SESSION['mensaje'] = "Error al cancelar la cita";
    return false;
}

// Obtener citas del paciente actual
function obtenerCitas($paciente_id)
{
    $pdo = conectarBD();

    $stmt = $pdo->prepare(
        "SELECT c.*, m.nombre AS medico_nombre, m.especialidad, m.consulta
         FROM citas c
         JOIN medicos m ON c.medico_id = m.id
         WHERE c.paciente_id = :paciente_id
         ORDER BY c.fecha DESC"
    );
    $stmt->execute(['paciente_id' => $paciente_id]);

    $citas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    desconectar($pdo);

    return $citas;
}

// Obtener médicos disponibles
function obtenerMedicos()
{
    $pdo = conectarBD();

    $stmt = $pdo->prepare("SELECT * FROM medicos ORDER BY nombre");
    $stmt->execute();

    $medicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    desconectar($pdo);

    return $medicos;
}

// Cambiar estado de cita (de programada a atendida)
function cambiarEstadoCita($cita_id, $paciente_id): bool
{
    $pdo = conectarBD();

    // Obtener estado actual
    $stmt = $pdo->prepare(
        "SELECT activa FROM citas WHERE id = :cita_id AND paciente_id = :paciente_id"
    );
    $stmt->execute([
        'cita_id'     => $cita_id,
        'paciente_id' => $paciente_id
    ]);

    $cita = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($cita)) {
        $_SESSION['mensaje'] = "La cita no existe";
        desconectar($pdo);
        return false;
    }

    // Si está activa (1), la marcamos como atendida (0)
    if ((int)$cita['activa'] === 1) {
        $stmt = $pdo->prepare(
            "UPDATE citas SET activa = 0 WHERE id = :cita_id AND paciente_id = :paciente_id"
        );
        $stmt->execute([
            'cita_id'     => $cita_id,
            'paciente_id' => $paciente_id
        ]);

        desconectar($pdo);

        $_SESSION['mensaje'] = "Cita actualizada correctamente";
        return true;
    }

    // Ya estaba atendida
    desconectar($pdo);
    $_SESSION['mensaje'] = "La cita ya estaba atendida";
    return false;
}
