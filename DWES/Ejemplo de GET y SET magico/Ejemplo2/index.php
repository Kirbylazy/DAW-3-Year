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
    $incluirCorreo = isset($_POST['incluir_correo']);
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $incluirTelefono = isset($_POST['incluir_telefono']);
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';

    // Validación y creación de la persona
    if (!empty($nombre) && !empty($apellido) && !empty($edad) && !empty($dni)) {
        $persona = new Persona($nombre, $apellido, $edad, $dni);

        // Asignación de campos dinámicos usando __set()
        if ($incluirCorreo && !empty($correo)) {
            $persona->correo = $correo;
        }

        if ($incluirTelefono && !empty($telefono)) {
            $persona->telefono = $telefono;
        }

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

        <hr>
        <h3>Campos opcionales (propiedades dinámicas)</h3>

        <p>
            <input type="checkbox" id="incluir_correo" name="incluir_correo" onchange="toggleCampo('correo')">
            <label for="incluir_correo">Incluir correo electrónico</label>
        </p>
        <p style="margin-left: 20px;">
            <input type="email" id="correo" name="correo" disabled>
        </p>

        <p>
            <input type="checkbox" id="incluir_telefono" name="incluir_telefono" onchange="toggleCampo('telefono')">
            <label for="incluir_telefono">Incluir teléfono</label>
        </p>
        <p style="margin-left: 20px;">
            <input type="tel" id="telefono" name="telefono" disabled>
        </p>

        <p>
            <button type="submit">Crear Persona</button>
        </p>
    </form>

    <script>
        function toggleCampo(campo) {
            const checkbox = document.getElementById('incluir_' + campo);
            const input = document.getElementById(campo);
            input.disabled = !checkbox.checked;
            if (!checkbox.checked) {
                input.value = '';
            }
        }
    </script>

    <?php if ($mensajeExito): ?>
        <h2><?php echo $mensajeExito; ?></h2>
    <?php endif; ?>

    <?php if ($persona !== null): ?>
        <h2>Datos de la Persona Creada:</h2>
        <!-- Visualización usando __toString() -->
        <pre><?php echo $persona; ?></pre>

        <h3>Accediendo a propiedades con getters comunes:</h3>
        <!-- Métodos getter tradicionales para acceder a las propiedades -->
        <ul>
            <li>Nombre: <?php echo $persona->getNombre(); ?></li>
            <li>Apellido: <?php echo $persona->getApellido(); ?></li>
            <li>Edad: <?php echo $persona->getEdad(); ?> años</li>
            <li>DNI: <?php echo $persona->getDni(); ?></li>
            <li>Nombre Completo: <?php echo $persona->getNombreCompleto(); ?></li>
        </ul>

        <?php if (!empty($persona->getCamposDinamicos())): ?>
            <h3>Campos Dinámicos (almacenados en array):</h3>
            <!-- El método __set() permite crear propiedades dinámicas que no existen en la clase -->
            <ul>
                <?php foreach ($persona->getCamposDinamicos() as $campo => $valor): ?>
                    <li><strong><?php echo ucfirst($campo); ?>:</strong> <?php echo $valor; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
