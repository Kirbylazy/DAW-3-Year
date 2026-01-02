<?php

session_start();

if (!isset($_SESSION['usuario']) || isset($_POST['cerrar'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
}

$usuario = $_SESSION['usuario'];

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

//Obtener notas del usuario
$sql = "SELECT asignatura, nota FROM notas WHERE  id_usuario = :id_usuario";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':id_usuario', $usuario['id'], PDO::PARAM_INT);

//Ejecutar la consulta
$stmt->execute();

?>

<h1>Hola, <?php echo $usuario['nombre'] ?></h1>
<h2>Tus notas:</h2>

<?php
// Si el statement está vacío
if (empty($stmt)) {
    echo "No tienes notas asignadas.";
} else {
?>
    <table style="border: 1px solid black; ">
        <tr>
            <th style="border: 1px solid black; ">Asignatura</th>
            <th style="border: 1px solid black; ">Nota</th>
        </tr>
        <?php
        // Recorro en el while el stmt
        while ($nota = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <tr>
                <td style="border: 1px solid black; "><?php echo $nota['asignatura']; ?></td>
                <td style="border: 1px solid black; "><?php echo $nota['nota']; ?></td>
            </tr>

        <?php
        }

        ?>
    </table><br>
<?php
}
?>

<form method="POST">
    <button type="submit" name="cerrar">Cerrar</button>
</form>