<?php
require_once('funciones.php');
session_start();

/* ===========================
   CONTROLADOR (POST actions)
   =========================== */

if (isset($_POST['seed'])) {
    insertarProductosDePrueba();
    header("Location: index.php");
    exit();
}

if (isset($_POST['crear'])) {
    crearProducto($_POST['nombre'], $_POST['descripcion'], $_POST['precio']);
}

if (isset($_POST['borrar']) && isset($_POST['id'])) {
    eliminarProducto($_POST['id']);
    header("Location: index.php");
    exit();
}

if (isset($_POST['editar']) && isset($_POST['id'])) {
    $_SESSION['producto'] = obtenerProductoPorId($_POST['id']);
}

if (isset($_POST['actualizar'])) {
    $id = $_SESSION['producto']['id'];

    actualizarProducto(
        $id,
        $_POST['nombre'],
        $_POST['descripcion'],
        $_POST['precio']
    );

    unset($_SESSION['producto']);
    header("Location: index.php");
    exit();
}

if (isset($_POST['cancelar'])) {
    unset($_SESSION['producto']);
    header("Location: index.php");
    exit();
}


/* ===========================
   DATOS PARA LA VISTA
   =========================== */

$productos = obtenerProductos();
$productoEditar = $_SESSION['producto'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Productos</title>
</head>
<body>

<h1>Gestión de Productos</h1>

<!-- =======================
     FORMULARIO DE EDICIÓN
     ======================= -->
<?php if ($productoEditar): ?>
<h2>Editar producto</h2>
<form method="post">
    <input type="text" name="nombre" value="<?= htmlspecialchars($productoEditar['nombre']) ?>" required><br>
    <textarea name="descripcion"><?= htmlspecialchars($productoEditar['descripcion']) ?></textarea><br>
    <input type="number" step="0.01" name="precio" value="<?= $productoEditar['precio'] ?>" required><br>
    <button type="submit" name="actualizar">Actualizar</button><br>
    <button type="submit" name="cancelar">Cancelar</button><br>
</form>
<?php endif; ?>

<!-- =======================
     FORMULARIO DE CREACIÓN
     ======================= -->
<h2>Añadir producto</h2>
<form method="post">
    <input type="text" name="nombre" placeholder="Nombre" required><br>
    <textarea name="descripcion" placeholder="Descripción"></textarea><br>
    <input type="number" step="0.01" name="precio" placeholder="Precio" required><br>
    <button type="submit" name="crear">Añadir</button>
    <button type="submit" name="seed">Cargar 10 productos de prueba</button>
</form>

<!-- =======================
     LISTADO
     ======================= -->
<h2>Lista de productos</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Fecha de Creacion</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($productos as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['nombre'] ?></td>
        <td><?= $p['descripcion'] ?></td>
        <td><?= $p['precio'] ?> €</td>
        <td><?= $p['fecha_creacion'] ?></td>
        <td>
            <form method="post">
                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                <button type="submit" name="editar">Editar</button>
            </form>

            <form method="post">
                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                <button type="submit" name="borrar">Borrar</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
