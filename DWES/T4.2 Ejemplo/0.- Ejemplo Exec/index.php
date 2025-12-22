<?php
// Conexión a la base de datos
$host = 'localhost';
$dbname = 'tienda';
$username = 'root';  
$password = '';     

try {
    // Crear la conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}

// Consulta para insertar un nuevo cliente
$nombre = 'Sofía López';
$email = 'sofia@mail.com';
$telefono = '555-2345';
$direccion = 'Calle 123, Ciudad W';

$sql = "INSERT INTO clientes (nombre, email, telefono, direccion) 
        VALUES ('$nombre', '$email', '$telefono', '$direccion')";

// Ejecutar la consulta con exec
$affectedRows = $pdo->exec($sql);

echo "Filas afectadas: " . $affectedRows;
?>
