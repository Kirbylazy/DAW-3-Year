<?php
require_once('funciones.php');
session_start();

if (isset($_POST['cerrar'])) {
    $_SESSION = [];
    session_destroy();
    header('Location: index.php');
    exit();
}

if (isset($_POST['volver'])){
    $_POSt = [];
    exit();
}

if (isset($_POST['misRecetas'])) {
    $seleccion = obtenerRecetas($_SESSION['id']);
}

if ($_SESSION['nombre'] != null){
    header('Location: principal.php');
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Principal</title>
</head>

<body>
    <h1>Recetario</h1>
    <h2>Hola <?= $_SESSION['nombre'] ?>></h2>
    <form action="" method="POST">
    
        <input type="number" name="id" value="id receta" required>
        <button type="submit" name="listado">Buscar</button><br>
        <button type="submit" name="misRecetas">Mis recetas</button><br>
        <button type="submit" name="cerrar">Cerrar sesión</button><br>
        <br><br>
    </form>

    <?php if (isset($_POST['buscar'])){
        
        $receta = mostrarReceta($_POST['id'])?>

        <h3>Receta buscada</h3>
        <TABLE border=1>
        <tr>

            <th>Título</th>
            <th>Descripción</th>
            <th>Fecha de Cración</th>

        </tr>
        <tr>

            <td><?= $receta['titulo'] ?></td>
            <td><?= $receta['descripcion'] ?></td>
            <td><?= $receta['fecha_creacion'] ?></td>

        </tr>
    </TABLE>

        <?php }?>

    <?php if(isset($_POST['misRecetas'])){ ?>
    <TABLE border=1>
        <tr>

            <th>Título</th>
            <th>Descripción</th>
            <th>Fecha de Cración</th>
            <th>Acciones</th>

        </tr>
        <?php foreach ($seleccion as $s){ ?>
            <tr>
                <td><?= $s['titulo'] ?></td>
                <td><?= $s['descripcion'] ?></td>
                <td><?= $s['fecha_creacion'] ?></td>
                <td>
                    <form action="" method="POST">
                        <button type="submit" name="detalle" value="" ?>>Detalle</button>
                    </form>
                </td>

            </tr>
    <?php } ?>

    </TABLE>
    <?php } ?>
</body>

</html>