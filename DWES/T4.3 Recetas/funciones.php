<?php
require_once('parametros.php');

// PUEDES USAR ESTAS FUNCIONES U OTRAS QUE TU ELIJAS
function conectar()
{
    try {
        // Crear la conexión PDO
        $conexion = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME . ";charset=utf8mb4", USERNAME, PASSWORD);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establecer manejo de errores
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit();
    }

    return $conexion;
}

function desconectar(&$conexion)
{
        $conexion = null;
}

function recetafavorita()
{
    $conexion = conectar();

    $sql = "SELECT r.*, COUNT(f.id) AS total_favoritos FROM favoritos f
            JOIN recetas r ON r.id = f.receta_id GROUP BY r.id HAVING COUNT(f.id) = (
            SELECT MAX(total) FROM (SELECT COUNT(*) AS total FROM favoritos GROUP BY 
            receta_id) AS conteo)";
    
    $stm = $conexion->prepare($sql);
    $stm->execute();

    $favoritos = $stm->fetchAll(PDO::FETCH_ASSOC);

    desconectar($conexion);

    return $favoritos;
}

function login($email, $contraseña)
{
    $conexion = conectar();

    $sql = "
        SELECT id, nombre, email, password_hash
        FROM usuarios
        WHERE email = :email
        LIMIT 1
    ";

    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    desconectar($conexion);

    // Si no existe el usuario
    if (!$usuario) {
        return false;
    }

    // Verificar la contraseña contra el hash almacenado
    if (!password_verify($contraseña, $usuario['password_hash'])) {
        return false;
    }

    // Login correcto → crear sesión
    session_regenerate_id(true);
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nombre'] = $usuario['nombre'];
    $_SESSION['usuario_email'] = $usuario['email'];

    return true;
}

function registrar($nombre, $email, $clave, $confirmacion)
{
    // 1. Validación de contraseñas
    if ($clave !== $confirmacion) {
        return [
            'ok' => false,
            'error' => 'Las contraseñas no coinciden'
        ];
    }

    $conexion = conectar();

    // 2. Comprobar si el email ya existe
    $sql = "SELECT id FROM usuarios WHERE email = :email";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->fetch()) {
        desconectar($conexion);
        return [
            'ok' => false,
            'error' => 'Este email ya está registrado'
        ];
    }

    // 3. Crear hash de la contraseña
    $hash = password_hash($clave, PASSWORD_DEFAULT);

    // 4. Insertar usuario
    $sql = "INSERT INTO usuarios (nombre, email, password_hash)
            VALUES (:nombre, :email, :hash)";

    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':hash', $hash);
    $stmt->execute();

    desconectar($conexion);

    return [
        'ok' => true
    ];
}

function mostrarReceta($idReceta)
{
    $conexion = conectar();

    $sql = 'SELECT titulo, descripcion, fecha_creacion FROM recetas WHERE id = :idReceta';
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':idReceta', $idReceta);
    $stmt->execute();

    desconectar($conexion);

    return $stmt->fetchAll();
}

function obtenerRecetas($id)
{
    $conexion = conectar();

    $sql = 'SELECT titulo, descripcion, fecha_creacion FROM recetas WHERE usuraio_id = :usurio_id';
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':usuario_id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $seleccion = $stmt->fetchAll(PDO::FETCH_ASSOC);

    desconectar($conexion);

    return $seleccion;
}

function obtenerDetalle($id)
{

}

function guardarValoracion($usuario, $receta, $puntuacion, $comentario, $marcarFavorito)
{

}

function esFavorito($usuario, $receta): bool
{

}

function getValoracion($usuario, $receta)
{

}
