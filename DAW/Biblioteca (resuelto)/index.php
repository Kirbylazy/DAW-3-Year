<?php
require_once('clases.php');
require_once('funciones.php');
// Procesar formularios
$mensajeEstado = obtenerMensaje();
$tipoSeleccionado = isset($_POST['tipo']) ? $_POST['tipo'] : 'libro';
if (!isset($_COOKIE['tipo'])) {
    $_COOKIE['tipo'] = 'libro';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['añadir_libro'])) {
        $isbn = $_POST['isbn'];
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        anadirMaterial(new Libro($isbn, $titulo, $autor));
        $mensaje = "Libro añadido correctamente";
        setcookie("mensaje", $mensaje, time() + 5);
    }

    if (isset($_POST['añadir_revista'])) {
        $issn = $_POST['issn'];
        $titulo = $_POST['titulo'];
        $numero = $_POST['numero'];
        anadirMaterial(new Revista($issn, $titulo, $numero));
        $mensaje = "Revista añadida correctamente";
        setcookie("mensaje", $mensaje, time() + 5);
    }

    if (isset($_POST['cambiar'])) {
        cambiarDisponibilidad($_POST['cambiar']);
        $mensaje = "Disponibilidad actualizada";
        setcookie("mensaje", $mensaje, time() + 5);
    }
    if (isset($_POST['consultar'])) {
        registrarVisita($_POST['consultar']);
        $mensaje = "Consulta registrada en cookies";
        setcookie("mensaje", $mensaje, time() + 5);
    }
    if (isset($_POST['borrar'])) {
        borrarMaterial($_POST['borrar']);
        $mensaje = "Material eliminado correctamente";
        setcookie("mensaje", $mensaje, time() + 5);
    }
    if (isset($_POST['tipo'])) {
        setcookie("tipo", $_POST['tipo'], time() + 86000);
    }

    header("Refresh: 0");
}

// Obtener materiales para mostrar
$materiales = leerMateriales();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Biblioteca</title>
    <style>
        body {
            font-family: Arial;
            margin: 20px;
        }

        h1,
        h2,
        h3 {
            color: #333;
        }

        .mensaje {
            background: #f0f0f0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        form {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin: 5px 0;
        }

        input,
        select {
            margin-bottom: 10px;
        }

        .formulario {
            border: 1px solid #000;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h1>Biblioteca</h1>

    <div class="mensaje"><?php echo $mensajeEstado; ?></div>

    <!-- Selector de tipo de material -->
    <h2>Añadir Material</h2>
    <form method="post">
        <label>Tipo de material:</label>
        <select name="tipo" onchange="this.form.submit()">
            <option value="libro" <?php if ($_COOKIE['tipo'] == 'libro') { echo "selected"; } ?>>Libro</option>
            <option value="revista" <?php if ($_COOKIE['tipo'] == 'revista') { echo "selected"; } ?>>Revista</option>
        </select>
    </form>

    <!-- Formulario específico según el tipo seleccionado -->
    <div class="formulario">
        <?php if ($_COOKIE['tipo'] == 'libro'): ?>
            <!-- Formulario para libros -->
            <form method="post">
                <h3>Añadir Libro</h3>

                <label>ISBN:</label>
                <input type="text" name="isbn" required>

                <label>Título:</label>
                <input type="text" name="titulo" required>

                <label>Autor:</label>
                <input type="text" name="autor" required>

                <button type="submit" name="añadir_libro">Añadir Libro</button>
            </form>
        <?php else: ?>
            <!-- Formulario para revistas -->
            <form method="post">
                <h3>Añadir Revista</h3>

                <label>ISSN:</label>
                <input type="text" name="issn" required>

                <label>Título:</label>
                <input type="text" name="titulo" required>

                <label>Número:</label>
                <input type="text" name="numero" required>

                <button type="submit" name="añadir_revista">Añadir Revista</button>
            </form>

        <?php endif;

        // Mensaje de la última acción realizada
        if (isset($_COOKIE["mensaje"])) {
            $mensajeAccion = $_COOKIE["mensaje"];
            echo $mensajeAccion;
        }

        ?>
    </div>

    <!-- Lista de materiales -->
    <h2>Materiales Disponibles</h2>
    <?php if (empty($materiales)): ?>
        <p>No hay materiales en la biblioteca.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Tipo</th>
                <th>Identificador</th>
                <th>Título</th>
                <th>Detalles</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($materiales as $material): ?>
                <tr>
                    <td><?php echo ($material instanceof Libro) ? "Libro" : "Revista"; ?></td>
                    <td><?php echo $material->identificador; ?></td>
                    <td><?php echo $material->titulo; ?></td>
                    <td>
                        <?php
                        if ($material instanceof Libro) {
                            echo "Autor: " . $material->autor;
                        } else {
                            echo "Número: " . $material->numero;
                        }
                        ?>
                    </td>
                    <td><?php echo $material->disponible ? "Disponible" : "No disponible"; ?></td>
                    <td>
                        <form method="post" style="display: inline; margin: 0;">
                            <button type="submit" name="cambiar" value="<?php echo $material->identificador; ?>">Cambiar disponibilidad</button>
                        </form>

                        <form method="post" style="display: inline; margin: 0;">
                            <button type="submit" name="consultar" value="<?php echo $material->identificador; ?>">Consultar</button>
                        </form>

                        <form method="post" style="display: inline; margin: 0;">
                            <button type="submit" name="borrar" value="<?php echo $material->identificador; ?>">Borrar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>

</html>