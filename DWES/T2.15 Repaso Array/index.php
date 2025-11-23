<?php 

// Ejercicio Práctico: Sistema de Gestión de Inventario - TechStyle
// Contexto Empresarial
// Eres el desarrollador web de TechStyle, una tienda online especializada en ropa y accesorios tecnológicos. La empresa trabaja 
// con 3 proveedores diferentes que suministran productos similares, pero con distintos precios y stocks.
// El departamento de logística necesita una herramienta web que les permita:
// Visualizar los inventarios de cada proveedor 
// Realizar operaciones de análisis y gestión sobre estos inventarios 
// Tomar decisiones informadas sobre compras y ventas

// Descripción del Sistema

// Debes desarrollar una aplicación web en PHP que conste de dos archivos:

// 📄 funciones.php
// Archivo que contiene:
// Funciones para obtener datos: Tres funciones que devuelven los inventarios iniciales de cada proveedor (arrays asociativos) 
// Funciones de operaciones: Ocho funciones que realizan las operaciones del sistema usando exclusivamente funciones de arrays de PHP 
// Tipos de retorno: Todas las funciones deben declarar sus tipos de parámetros y retorno 
// Sin HTML: Las funciones solo devuelven datos (arrays, números, strings), nunca código HTML 

// 📄 index.php
// Página web que contiene:
// Inclusión de funciones: require_once 'funciones.php' 
// Visualización de inventarios: Tres tablas HTML mostrando los productos de cada proveedor 
// Panel de operaciones: Ocho botones, uno por cada funcionalidad 
// Gestión de resultados: Estructura switch(true) que detecta qué botón se pulsó y muestra los resultados 
// Renderizado con foreach: Todo el HTML se genera usando bucles foreach directamente en el código HTML 
// Funcionalidades Requeridas
// Implementa las siguientes 8 operaciones con sus respectivos botones:

// 1. Productos Exclusivos del Proveedor A
// Botón: "Productos Exclusivos A"
// Función a usar: array_diff_key()
// Descripción: Muestra los productos que solo tiene el Proveedor A y no tienen los otros proveedores.
// Salida: Tabla con los productos exclusivos.

// 2. Catálogo Unificado
// Botón: "Catálogo Unificado"
// Función a usar: array_merge()
// Descripción: Une todos los productos de los 3 proveedores en un único catálogo.
// Salida: Tabla con todos los productos.

// 3. Primeros 3 Productos
// Botón: "Primeros 3 Productos"
// Función a usar: array_slice()
// Descripción: Extrae los 3 primeros productos del catálogo unificado.
// Salida: Tabla con 3 productos.

// 4. Producto Aleatorio
// Botón: "Producto Aleatorio"
// Función a usar: array_rand()
// Descripción: Selecciona un producto al azar del catálogo unificado.
// Salida: Tabla con 1 producto aleatorio.

// 5. Estadísticas del Sistema
// Botón: "Estadísticas"
// Funciones a usar: count(), max(), min()
// Descripción: Calcula y muestra estadísticas generales del inventario.
// Salida: Tabla mostrando:
// Total de productos por proveedor 
// Total general de productos 
// Precio máximo encontrado 
// Precio mínimo encontrado 

// 6. Buscar Producto
// Botón: "Buscar Producto [CÓDIGO]"
// Función a usar: array_key_exists()
// Descripción: Busca un código específico (ej: "P002") en todos los proveedores y muestra en cuáles está disponible.
// Salida: Tabla mostrando el producto y en qué proveedores se encuentra, con una columna adicional indicando el proveedor.

// 7. Ordenar por Precio
// Botón: "Ordenar por Precio (A)"
// Función a usar: asort()
// Descripción: Muestra los productos del Proveedor A ordenados de menor a mayor precio.
// Salida: Tabla con productos ordenados.

// 8. Simular Venta
// Botón: "Simular Venta"
// Función a usar: array_shift()
// Descripción: Elimina el primer producto del Proveedor A (simulando una venta) y muestra el producto vendido y el inventario actualizado.
// Salida: Mensaje indicando qué producto se vendió 
// Tabla con el inventario actualizado del Proveedor A


require_once ("funciones.php");

$provA = obtenerProveedorA();
$provB = obtenerProveedorB();
$provC = obtenerProveedorC();

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Proveedores</title>
    </head>
    <body>
        <table border=1>
            <tr>
                <th>Código</th><th>Nombre</th><th>Stock</th><th>precio</th><th>Categoria</th>
            </tr>
            <?php foreach ($provA as $codigo => $producto): ?>
            <tr>
                <td><?= $codigo ?></td>
                <td><?= $producto["nombre"] ?></td>
                <td><?= $producto["stock"] ?></td>
                <td><?= $producto["precio"] ?></td>
                <td><?= $producto["categoria"] ?></td>
            </tr>
            <?php endforeach ?>
        </table>
        <br>
        <form method="POST" action="">
            <button type = "submit" name = "SoloA" >Productos unicos del Proveedor A</button>
        </form>
        <br>
        <br>
        <table border=1>
            <tr>
                <th>Código</th><th>Nombre</th><th>Stock</th><th>precio</th><th>Categoria</th>
            </tr>
            <?php foreach ($provB as $codigo => $producto): ?>
            <tr>
                <td><?= $codigo ?></td>
                <td><?= $producto["nombre"] ?></td>
                <td><?= $producto["stock"] ?></td>
                <td><?= $producto["precio"] ?></td>
                <td><?= $producto["categoria"] ?></td>
            </tr>
            <?php endforeach ?>
        </table>
        <br>
        <form method="POST" action="">
            <button type = "submit" name = "SoloB" >Productos unicos del Proveedor B</button>
        </form>
        <br>
        <br>
        <table border=1>
            <tr>
                <th>Código</th><th>Nombre</th><th>Stock</th><th>precio</th><th>Categoria</th>
            </tr>
            <?php foreach ($provC as $codigo => $producto): ?>
            <tr>
                <td><?= $codigo ?></td>
                <td><?= $producto["nombre"] ?></td>
                <td><?= $producto["stock"] ?></td>
                <td><?= $producto["precio"] ?></td>
                <td><?= $producto["categoria"] ?></td>
            </tr>
            <?php endforeach ?>
        </table>
        <br>
        <form method="POST" action="">
            <button type = "submit" name = "SoloC" >Productos unicos del Proveedor C</button>
        </form>
        <br>
        <br>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"):

            if(isset($_POST['SoloA'])):

                $solo = array_diff_key($provA,$provB);
                $soloA = array_diff_key($solo,$provC);
                
                ?>

            <table border=1>
            <tr>
                <th>Código</th><th>Nombre</th><th>Stock</th><th>precio</th><th>Categoria</th>
            </tr>
            <?php foreach ($soloA as $codigo => $producto): ?>
            <tr>
                <td><?= $codigo ?></td>
                <td><?= $producto["nombre"] ?></td>
                <td><?= $producto["stock"] ?></td>
                <td><?= $producto["precio"] ?></td>
                <td><?= $producto["categoria"] ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <?php endif;?>

            <?php if(isset($_POST['SoloB'])):

                    $solo = array_diff_key($provB,$provA);
                    $soloB = array_diff_key($solo,$provC);
                    
                    ?>

                <table border=1>
                <tr>
                    <th>Código</th><th>Nombre</th><th>Stock</th><th>precio</th><th>Categoria</th>
                </tr>
                <?php foreach ($soloB as $codigo => $producto): ?>
                <tr>
                    <td><?= $codigo ?></td>
                    <td><?= $producto["nombre"] ?></td>
                    <td><?= $producto["stock"] ?></td>
                    <td><?= $producto["precio"] ?></td>
                    <td><?= $producto["categoria"] ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <br>
            <?php endif;?>

            <?php if(isset($_POST['SoloC'])):

                    $solo = array_diff_key($provC,$provB);
                    $soloC = array_diff_key($solo,$provA);
                    
                    ?>

                <table border=1>
                <tr>
                    <th>Código</th><th>Nombre</th><th>Stock</th><th>precio</th><th>Categoria</th>
                </tr>
                <?php foreach ($soloC as $codigo => $producto): ?>
                <tr>
                    <td><?= $codigo ?></td>
                    <td><?= $producto["nombre"] ?></td>
                    <td><?= $producto["stock"] ?></td>
                    <td><?= $producto["precio"] ?></td>
                    <td><?= $producto["categoria"] ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <br>
            <?php endif; endif;?>

        <form method="POST" action="">
            <button type = "submit" name = "merge" >Todos los Productos</button>
        </form>
        <br>
        <br>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"):

            if(isset($_POST['merge'])):

                $merge = array_merge($provA,$provB,$provC);

                ?>

                <table border=1>
                <tr>
                    <th>Código</th><th>Nombre</th><th>Stock</th><th>precio</th><th>Categoria</th>
                </tr>
                <?php foreach ($merge as $codigo => $producto): ?>
                <tr>
                    <td><?= $codigo ?></td>
                    <td><?= $producto["nombre"] ?></td>
                    <td><?= $producto["stock"] ?></td>
                    <td><?= $producto["precio"] ?></td>
                    <td><?= $producto["categoria"] ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <br>
            <?php endif;endif;?>

        <form method="POST" action="">
            <button type = "submit" name = "solo3" >3 primeros productos</button>
        </form>
        <br>
        <br>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"):

            if(isset($_POST['solo3'])):

                $merge = array_merge($provA,$provB,$provC);
                $keys = array_keys($merge);

                ?>

                <table border=1>
                <tr>
                    <th>Código</th><th>Nombre</th><th>Stock</th><th>precio</th><th>Categoria</th>
                </tr>
                <?php for ($i = 0; $i < 3; $i++): ?>
                <tr>
                    <td><?= $keys[$i] ?></td>
                    <td><?= $merge[$keys[$i]]["nombre"] ?></td>
                    <td><?= $merge[$keys[$i]]["stock"] ?></td>
                    <td><?= $merge[$keys[$i]]["precio"] ?></td>
                    <td><?= $merge[$keys[$i]]["categoria"] ?></td>
                </tr>
                <?php endfor; ?>
            </table>
            <br>
            <?php endif;endif;?>

        <form method="POST" action="">
            <button type = "submit" name = "rand" >Producto Aleatorio</button>
        </form>
        <br>
        <br>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"):

            if(isset($_POST['rand'])):

                $merge = array_merge($provA,$provB,$provC);
                $rand = array_rand($merge);

                ?>

                <table border=1>
                <tr>
                    <th>Código</th><th>Nombre</th><th>Stock</th><th>precio</th><th>Categoria</th>
                </tr>
                <tr>
                    <td><?= $rand ?></td>
                    <td><?= $merge[$rand]["nombre"] ?></td>
                    <td><?= $merge[$rand]["stock"] ?></td>
                    <td><?= $merge[$rand]["precio"] ?></td>
                    <td><?= $merge[$rand]["categoria"] ?></td>
                </tr>
            </table>
            <br>
            <?php endif;endif;?>
    </body>
</html>