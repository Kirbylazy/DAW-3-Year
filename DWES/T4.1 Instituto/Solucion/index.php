<?php
//require_once('clases.php');
session_start();

if(isset($_SESSION['usuario']))
{
    $usuario = $_SESSION['usuario'];
}else
{
    $usuario = [];
}

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
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    /**
     *  BOTÓN INICIAR
     */
    if(isset($_POST['iniciar']))
    {
        // Obtener los datos del formulario
        $email = $_POST['email'];
        $clave = $_POST['clave'];

        //Buscar el usuario en la base de datos
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        //Preparar la consulta
        $stmt = $conexion->prepare($sql);

        //Vincular los parámetros con los valores
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        //Ejecutar la consulta
        $stmt->execute();

        /*Obtiene la primera fila de una consulta realizada en la base de datos y
        la almacena en la variable $usuario como un array asociativo, las claves 
        corresponden a los nombres de las columnas de la tabla*/
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario existe y si la clave es correcta
        if ($usuario) 
        {
            if(password_verify($clave, $usuario['clave'])) 
            {
                //Meter el contenido de usuario en la sesión
                $_SESSION['usuario'] = $usuario;

                //Redirección según el rol
                if($usuario['rol'] == 'a')
                {
                    header('Location: alumno.php');
                }
                else
                {
                    header('Location: profesor.php');
                }
                exit;
            }else 
            {
                echo "Contraseña incorrecta.";
            }   
        } else 
        {
            echo "Usuario incorrecto.";
        }
    }

    /**
     *  BOTÓN REGISTRO
     */
    if(isset($_POST['registro']))
    {
        // Establecer cookie de duración
        setcookie("registro", time(), time() + 30);
        header('Location: registro.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="index.php" method="POST">
        <label for="email">Email:</label>
        <input type="text" name="email" ><br>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave" ><br>
        <button type="submit" name="iniciar">Iniciar sesión</button>
        <button type="submit" name="registro">Registro</button>
    </form>
</body>
</html>
