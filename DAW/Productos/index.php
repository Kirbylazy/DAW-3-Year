<?php
// index.php
session_start();

require_once('parametros.php');
require_once('funciones.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['crear'])) {
        // Crear producto
        if (isset($_POST['nombre'], $_POST['descripcion'], $_POST['precio'])) {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            crearProducto($nombre, $descripcion, $precio);
            header('Location: index.php');
            exit();
        }
    }

    if (isset($_POST['actualizar'])) {
        // Editar producto
        if (isset($_POST['nombre'], $_POST['descripcion'], $_POST['precio'])) {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            actualizarProducto($_SESSION['producto']['id'], $nombre, $descripcion, $precio);
            header('Location: index.php');
            exit;
        }
    }

    if (isset($_POST['editar'])) {

        // Obtener datos del producto para editar
        $_SESSION['producto'] = obtenerProductoPorId($_POST['editar']);
    }





    if (isset($_POST['borrar'])) {
        // Eliminar producto
        eliminarProducto($_POST['borrar']);
        unset($_SESSION['id']);
        header('Location: index.php');
        exit();
    }
}

$productos = obtenerProductos();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
</head>

<body>
    <h1>Productos</h1>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar'])) {
    ?>
        <!-- Formulario para agregar producto -->
        <h2>Editar Producto</h2>
        <form action="" method="POST">
            <input type="text" name="nombre" value="<?= $_SESSION['producto']['nombre'] ?>" required>
            <textarea name="descripcion"><?= $_SESSION['producto']['descripcion'] ?></textarea>
            <input type="number" step="0.01" name="precio" value="<?= $_SESSION['producto']['precio'] ?>" required>
            <button type="submit" name="actualizar">Actualizar</button>
        </form>
    <?php
    } else {
    ?>
        <form action="" method="POST">
            <h2>Añadir producto</h2>
            <input type="text" name="nombre" placeholder="Nombre" required><br>
            <textarea name="descripcion" placeholder="Descripción"></textarea><br>
            <input type="number" step="0.01" name="precio" placeholder="Precio" required>
            <button type="submit" name="crear" value="crear">Añadir</button>
        </form>
    <?php
    }
    ?>


    <h2>Lista de productos</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Fecha de creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= $producto['id'] ?></td>
                    <td><?= $producto['nombre'] ?></td>
                    <td><?= $producto['descripcion'] ?></td>
                    <td><?= $producto['precio'] ?></td>
                    <td><?= $producto['fecha_creacion'] ?></td>
                    <td>
                        <form action="" method="POST">

                            <!-- Botones para editar y eliminar -->
                            <button type="submit" name="editar" value=<?php echo $producto['id']; ?>>Editar</button>
                            <button type="submit" name="borrar" value=<?php echo $producto['id']; ?>>Borrar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>