<?php
// Conexión a la base de datos
$host = 'localhost';
$dbname = 'tienda';
$username = 'root';  
$password = '';      

try {
    // Crear la conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establecer manejo de errores
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    // Preparar la consulta para insertar el nuevo cliente
    $sql = "INSERT INTO clientes (nombre, email, telefono, direccion) VALUES (:nombre, :email, :telefono, :direccion)";
    $stmt = $pdo->prepare($sql);

    // Vincular los parámetros con los valores
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
    $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Cliente agregado exitosamente.";
        header("Location: index.php");  // Redirigir a la página principal
        exit();
    } else {
        echo "Error al agregar el cliente.";
    }
}
?>
