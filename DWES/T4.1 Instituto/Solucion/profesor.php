<?php
//require_once('clases.php');

session_start();

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

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

//Obtener alumnos para la select list
$rol = 'a';
$sqlAlumno = "SELECT id, nombre FROM usuarios WHERE rol = :rol";
$stmtAlumno = $conexion->prepare($sqlAlumno);
$stmtAlumno->bindParam(':rol', $rol, PDO::PARAM_STR);
$stmtAlumno->execute();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['asignar'])) {
        $idAlumno = $_POST['alumno'];
        $asignatura = $_POST['asignatura'];
        $nota = $_POST['nota'];

        //Buscar el id del alumno en la BBDD
        $sqlAlumno = "SELECT id FROM usuarios WHERE id = :id AND rol = :rol";
        $stmtAlumno = $conexion->prepare($sqlAlumno);
        $stmtAlumno->bindParam(':id', $idAlumno, PDO::PARAM_STR);
        $stmtAlumno->bindParam(':rol', $rol, PDO::PARAM_STR);
        $stmtAlumno->execute();
        $alumno = $stmtAlumno->fetch(PDO::FETCH_ASSOC);

        if ($alumno) {

            //Insertar la nota en la BBDD
            $sqlNota = "INSERT INTO notas (id_usuario, asignatura, nota) VALUES (:id_usuario, :asignatura, :nota)";
            $stmtNota = $conexion->prepare($sqlNota);

            $stmtNota->bindParam(':id_usuario', $idAlumno, PDO::PARAM_INT);
            $stmtNota->bindParam(':asignatura', $asignatura, PDO::PARAM_STR);
            $stmtNota->bindParam(':nota', $nota, PDO::PARAM_STR);

            $stmtNota->execute();

            $mensaje = "Nota asignada correctamente.";
        } else {
            $mensaje = "El alumno no existe.";
        }
        header('Refresh: 0');
        exit;
    }


    if (isset($_POST['cerrar'])) {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
// Obtener notas de todos
$sqlNotas = "SELECT u.id, u.nombre, n.asignatura, n.nota 
               FROM usuarios u INNER JOIN notas n ON u.id = n.id_usuario WHERE rol = :rol";
$stmtNotas = $conexion->prepare($sqlNotas);
$stmtNotas->bindParam(':rol', $rol, PDO::PARAM_STR);
$stmtNotas->execute();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Profesor</title>
</head>

<body>
    <h2>Asignar Notas</h2>
    <form action="" method="POST">
        <label for="alumno">Nombre del alumno:</label>
        <select name="alumno" id="alumno">
            <?php
            while ($alumno = $stmtAlumno->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <option value="<?php echo $alumno['id']; ?>"><?php echo $alumno['id'] . ' - ' . $alumno['nombre']; ?></option>
            <?php
            }
            ?>
        </select>
        <label for="asignatura">Asignatura:</label>
        <input type="text" name="asignatura" required>
        <label for="nota">Nota:</label>
        <input type="number" name="nota" min="0" max="10" required>
        <button type="submit" name="asignar">Asignar nota</button>
    </form>

    <form action="" method="POST">
        <button type="submit" name="cerrar">Cerrar sessión</button>
    </form>


    <table style="border: 1px solid black; ">
        <tr>
            <th style="border: 1px solid black; ">ID</th>
            <th style="border: 1px solid black; ">Nombre</th>
            <th style="border: 1px solid black; ">Asignatura</th>
            <th style="border: 1px solid black; ">Nota</th>
        </tr>
        <?php
        while ($nota = $stmtNotas->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <tr>
                <td style="border: 1px solid black; "><?php echo $nota['id']; ?></td>
                <td style="border: 1px solid black; "><?php echo $nota['nombre']; ?></td>
                <td style="border: 1px solid black; "><?php echo $nota['asignatura']; ?></td>
                <td style="border: 1px solid black; "><?php echo $nota['nota']; ?></td>
            </tr>

        <?php
        }

        ?>
    </table>
</body>
</html>