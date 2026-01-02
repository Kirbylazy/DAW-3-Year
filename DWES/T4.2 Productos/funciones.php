<?php

require_once('parametros.php');

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

function crearProducto($nombre, $descripcion, $precio)
{
    $conexion = conectar();

    $sql = "INSERT INTO " . TABLE . " (nombre, descripcion, precio)
            VALUES (:nombre, :descripcion, :precio)";

    $stmt = $conexion->prepare($sql);

    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
    $stmt->bindValue(':precio', number_format($precio, 2, '.', ''));

    $stmt->execute();

    header('Location: index.php');
    exit();
}

function obtenerProductos()
{
    $conexion = conectar();

    $sql = "SELECT id, nombre, descripcion, precio, fecha_creacion FROM " . TABLE;
    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    desconectar($conexion);

    return $stmt->fetchAll();
}

function obtenerProductoPorId($id)
{
    $conexion = conectar();

   $sql = "SELECT id, nombre, descripcion, precio
            FROM " . TABLE . "
            WHERE id = :id";

    $stmt = $conexion->prepare($sql);
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();

    $producto = $stmt->fetch();

    desconectar($conexion);

    return $producto;
}

function actualizarProducto($id, $nombre, $descripcion, $precio)
{
    $conexion = conectar();

    $sql = "UPDATE " . TABLE . "
            SET nombre = :nombre,
                descripcion = :descripcion,
                precio = :precio
            WHERE id = :id";

    $stmt = $conexion->prepare($sql);

    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindValue(':descripcion', $descripcion, PDO::PARAM_STR);
    $stmt->bindValue(':precio', number_format($precio, 2, '.', ''), PDO::PARAM_STR);

    $stmt->execute();

    $conexion = null;
}

function eliminarProducto($id)
{
    $conexion = conectar();

    $sql = "DELETE FROM " . TABLE . " WHERE id = :id";
    $stmt = $conexion->prepare($sql);

    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();

    $conexion = null;
}

function insertarProductosDePrueba()
{
    $productos = [
        ['Teclado mecánico', 'Teclado RGB switches azules', 89.99],
        ['Ratón gaming', 'Ratón 16000 DPI', 49.95],
        ['Monitor 27"', 'Monitor IPS 144Hz', 229.90],
        ['Auriculares', 'Auriculares con cancelación de ruido', 119.50],
        ['Webcam HD', 'Webcam 1080p USB', 39.99],
        ['Altavoces', 'Altavoces estéreo 40W', 59.95],
        ['SSD 1TB', 'Disco sólido NVMe', 129.00],
        ['Portátil', 'Portátil 16GB RAM', 899.99],
        ['Impresora', 'Impresora láser monocromo', 199.90],
        ['Router WiFi 6', 'Router de alta velocidad', 149.99]
    ];

    $conexion = conectar();

    $sql = "INSERT INTO " . TABLE . " (nombre, descripcion, precio)
            VALUES (:nombre, :descripcion, :precio)";

    $stmt = $conexion->prepare($sql);

    foreach ($productos as $p) {
        $stmt->bindValue(':nombre', $p[0], PDO::PARAM_STR);
        $stmt->bindValue(':descripcion', $p[1], PDO::PARAM_STR);
        $stmt->bindValue(':precio', number_format($p[2], 2, '.', ''), PDO::PARAM_STR);
        $stmt->execute();
    }

    $conexion = null;
}
?>