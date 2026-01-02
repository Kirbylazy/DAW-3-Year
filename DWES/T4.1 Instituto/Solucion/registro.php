<?php
//require_once('clases.php');

if(!isset($_COOKIE['registro']))
{
    header('Location: index.php');
    exit();
}

setcookie("registro", time(), time() + 30);

// Conexión a la base de datos
$host = 'localhost';
$dbname = 'instituto';
$username = 'root';  
$password = '';      

try {
    // Crear la conexión PDO
    $conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establecer manejo de errores
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registrar'])) {
    // Obtener los datos del formulario
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];  
    $ciudad = $_POST['ciudad'];
    $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT);

    $rol = $_POST['tipo'];   // Tipo es en el formulario, rol en base de datos

    if (!empty($dni) && !empty($nombre)  && !empty($telefono) && !empty($email)  
    && !empty($ciudad)  && !empty($clave)  && !empty($rol)) 
    {

        // Preparar la consulta para insertar el nuevo alumno
        $sql = "INSERT INTO usuarios (dni, nombre, telefono, email, ciudad, clave, rol) VALUES (:dni, :nombre, :telefono, :email, :ciudad, :clave, :rol)";
        $stmt = $conexion->prepare($sql);

        // Vincular los parámetros con los valores
        $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':ciudad', $ciudad, PDO::PARAM_STR);
        $stmt->bindParam(':clave', $clave, PDO::PARAM_STR);
        $stmt->bindParam(':rol', $rol, PDO::PARAM_STR);

        if ($stmt->execute()) {

        // Guardamos mensaje en sesión (opcional)
        session_start();
        $_SESSION['mensaje'] = "Usuario registrado correctamente";

        // Redirección limpia
        header('Location: index.php');
        exit();

        } else {
            echo "Error al registrar usuario.";
        }
    } else {
        echo "Datos inválidos.";
    }

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form action="registro.php" method="POST">
        <label for="dni">DNI:</label>
        <input type="text" name="dni"><br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre"><br>
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono"><br>
        <label for="email">email:</label>
        <input type="text" name="email"><br>
        <label for="ciudad">Ciudad:</label>
        <input type="text" name="ciudad"><br>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave"><br>
        <label for="tipo">Tipo:</label>
        <select name="tipo">
            <option value="p">Profesor</option>
            <option value="a">Alumno</option>
        </select><br>
        <button type="submit" name="registrar">Registrar</button>
    </form>
</body>
</html>
