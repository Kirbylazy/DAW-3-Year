<?php
require_once 'clases.php';

// Inicialización de variables
$persona = null;
$mensajeExito = '';

// Procesamiento del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtención de datos del formulario con valores por defecto
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
    $edad = isset($_POST['edad']) ? $_POST['edad'] : '';
    $dni = isset($_POST['dni']) ? $_POST['dni'] : '';

    // Validación y creación de la persona
    if (!empty($nombre) && !empty($apellido) && !empty($edad) && !empty($dni)) {
        $persona = new Persona($nombre, $apellido, $edad, $dni);
        $mensajeExito = 'Persona creada correctamente';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Persona</title>
</head>
<body>
    <h1>Formulario de Persona</h1>

    <form method="POST" action="">
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </p>

        <p>
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>
        </p>

        <p>
            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" required min="0">
        </p>

        <p>
            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni" required>
        </p>

        <p>
            <button type="submit">Crear Persona</button>
        </p>
    </form>

    <?php if ($mensajeExito): ?>
        <h2><?php echo $mensajeExito; ?></h2>
    <?php endif; ?>

    <?php if ($persona !== null): ?>
        <h2>Datos de la Persona Creada:</h2>
        <!-- Visualización usando __toString() -->
        <pre><?php echo $persona; ?></pre>

        <h3>Accediendo a propiedades con __get():</h3>
        <!-- El método mágico __get() permite acceder a propiedades privadas -->
        <ul>
            <li>Nombre: <?php echo $persona->nombre; ?></li>
            <li>Apellido: <?php echo $persona->apellido; ?></li>
            <li>Edad: <?php echo $persona->edad; ?> años</li>
            <li>DNI: <?php echo $persona->dni; ?></li>
            <li>Nombre Completo: <?php echo $persona->getNombreCompleto(); ?></li>
        </ul>
    <?php endif; ?>
</body>
</html>
