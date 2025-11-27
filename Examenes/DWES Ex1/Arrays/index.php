<?php

include_once "recursos.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes y Productos</title>
</head>
<body>
    <h1>Sistema de Gestión de Clientes y Productos</h1>


    <h2>1. Lista Completa de Productos</h2>

    <?php 
    
    $clientes = obtenerArray();

    $productos = obtenerListaProductos($clientes);
    
    ?>

    <table border=1>
    <tr>
        <th>Código</th><th>Nombre</th><th>precio</th><th>Descripción</th>
    </tr>
    <?php foreach ($productos as $codigo => $producto): ?>
    <tr>
        <td><?= $codigo ?></td>
        <td><?= $producto["nombre"] ?></td>
        <td><?= $producto["precio"] ?></td>
        <td><?= $producto["descripcion"] ?></td>
    </tr>
    <?php endforeach; ?>
    </table>

    <h2>2. Clientes que compraron el Producto P001</h2>

    <?php $clientesPorProducto = obtenerClientesPorProductos($clientes, "P001") ?>

    <table border=1>
    <tr>
        <th>Código</th><th>Nombre</th><th>Apellidos</th>
    </tr>
    <?php foreach ($clientesPorProducto as $cliente): ?>
    <tr>
        <td><?= $cliente["id"] ?></td>
        <td><?= $cliente["nombre"] ?></td>
        <td><?= $cliente["apellidos"] ?></td>
    </tr>
    <?php endforeach; ?>
    </table>


    <h2>3. Productos con precio entre 20€ y 100€</h2>

    <?php $productosRango = obtenerProductosPorRangoPrecio($clientes,20,100); ?>

    <table border=1>
    <tr>
        <th>Código</th><th>Nombre</th><th>precio</th><th>Descripción</th>
    </tr>
    <?php foreach ($productosRango as $codigo => $producto): ?>
    <tr>
        <td><?= $codigo ?></td>
        <td><?= $producto["nombre"] ?></td>
        <td><?= $producto["precio"] ?></td>
        <td><?= $producto["descripcion"] ?></td>
    </tr>
    <?php endforeach; ?>
    </table>


    <h2>4. Cantidad de Productos por Cliente</h2>

    <?php $produtosPorCliente = contarProductosPorCliente($clientes); ?>

    <table border=1>
    <tr>
        <th>Nombre</th><th>apellidos</th><th>productos</th>
    </tr>
    <?php foreach ($produtosPorCliente as $codigo => $producto): ?>
    <tr>
        <td><?= $producto["nombre"] ?></td>
        <td><?= $producto["apellidos"] ?></td>
        <td><?= $producto["numero"] ?></td>
    </tr>
    <?php endforeach; ?>
    </table>

</body>