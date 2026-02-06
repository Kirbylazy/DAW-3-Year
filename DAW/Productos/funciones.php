<?php

require_once('parametros.php');

function conectar()
{
    // Intento de conexión
    try {
        $bbdd = "mysql:host=" . HOST . ";dbname=" . DBNAME;
        $pdo = new PDO($bbdd, USERNAME, PASSWORD);
        // Establecemos el modo de error de PDO a excepción
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo 'Error de conexión: ' . $e->getMessage();
    }
}

function desconectar($conexion)
{
    // Se desconecta
    $conexion = NULL;
}

function crearProducto($nombre, $descripcion, $precio)
{
    // Conexión y preparado
    $pdo = conectar();

    $sql = 'INSERT INTO productos (nombre, descripcion, precio) VALUES (:nombre, :descr, :precio)';
    $stmt = $pdo->prepare($sql);

    // Vinculación
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':descr', $descripcion);
    $stmt->bindParam(':precio', $precio);

    // Ejecutar
    $stmt->execute();

    // Desconectar
    desconectar($pdo);
}

function obtenerProductos()
{
    // Conexión y preparado
    $pdo = conectar();
    
    $stmt = $pdo->prepare('SELECT * FROM productos');
    // Ejecutar
    $stmt->execute();
    // Desconectar
    desconectar($pdo);
    return $stmt;
}

function obtenerProductoPorId($id)
{
    // Conexión y preparado
    $pdo = conectar();
    //Preparar
    $consulta = 'SELECT * FROM productos WHERE id = :id';
    $stmt = $pdo->prepare($consulta);

    // Vinculación
    $stmt->bindParam(':id', $id);

    // Ejecuta
    $stmt->execute();

    // Desconectar
    desconectar($pdo);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function actualizarProducto($id, $nombre, $descripcion, $precio)
{
    // Conexión y preparado
    $pdo = conectar();

    $consulta= 'UPDATE productos SET nombre = :nombre, descripcion = :descr, precio = :precio WHERE id = :id';
    $stmt = $pdo->prepare($consulta);

    // Vinculación
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':descr', $descripcion);
    $stmt->bindParam(':precio', $precio);
    $stmt->bindParam(':id', $id);

    // Ejecutar
    $stmt->execute();

    // Desconectar
    desconectar($pdo);
}

function eliminarProducto($id)
{
    // Conexión y preparado
    $pdo = conectar();

    // Preparar
    $stmt = $pdo->prepare('DELETE FROM productos WHERE id = :id');

    // Vinculación
    $stmt->bindParam(':id', $id);

    // Ejecución
    $stmt->execute();

    // Desconectar
    desconectar($pdo);
}
