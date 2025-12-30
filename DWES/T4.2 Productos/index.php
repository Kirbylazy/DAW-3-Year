<?php

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



        <!-- Formulario para agregar producto -->
        <h1>Editar Producto</h1>
        <form action="index.php<?= $_SESSION['id'] ?>" method="POST">
            <input type="text" name="nombre" value="<?= $_SESSION['nombre'] ?>" required>
            <textarea name="descripcion"><?= $_SESSION['descripcion'] ?></textarea>
            <input type="number" step="0.01" name="precio" value="<?= $_SESSION['precio'] ?>" required>
            <button type="submit">Actualizar</button>
        </form>

        <form action="" method="POST">
            <h1>Añadir producto</h1>
            <input type="text" name="nombre" placeholder="Nombre" required><br>
            <textarea name="descripcion" placeholder="Descripción"></textarea><br>
            <input type="number" step="0.01" name="precio" placeholder="Precio" required>
            <button type="submit" name="crear" value="crear">Añadir</button>
        </form>

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

                <tr>
                    <td><? ?></td>
                    <td><? ?></td>
                    <td><? ?></td>
                    <td><? ?></td>
                    <td><? ?></td>
                    <td>
                        <form action="" method="POST">
                            <!-- Botones para editar y eliminar -->
                            <button type="submit" name="editar" value="editar">Editar</button>
                            <button type="submit" name="borrar" value="borrar">Borrar</button>
                        </form>
                    </td>
                </tr>
        </tbody>
    </table>
</body>

</html>