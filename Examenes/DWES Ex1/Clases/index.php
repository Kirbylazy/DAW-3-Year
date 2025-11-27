<?php

// Crear catálogo de productos

    // Obtener producto seleccionado por ID

    // Crear cliente

    // Agregar productos comprados (el stock se reduce automáticamente)

    // Ejemplo de devolución de hardware usando métodos mágicos
        // Obtener uno de los productos comprados para devolverlo

        // Devolverlo al proveedor

require_once "clases.php";

$p1 = new Hardware(1,"Teclado",80,10,"LG");
$p2 = new Software(1,"Antivirus",50,5,"Anual");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alta de Cliente y Compra</title>
</head>
<body>
    <h1>Formulario de Alta de Cliente y Compra</h1>

    <h2>Cliente</h2>

    <form method="post" action="">

        <label for="nombre">nombre</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="email"><br><br>Email</label>
        <input type="text" name="email" id="email" required>

        <label for="cant"><br><br>Cantidad</label>
        <input type="number" name="cant" id="cant" required>

        <label for="tipo"><br><br>Productoroducto</label>
        <select id="tipo" name="tipo">
            <option value="hardware"><?= $p1 ?></option>
            <option value="software"><?= $p2 ?></option>
        </select>

        <button type="submit" name="confirmar">Enviar</button>
        <p><br></p>

    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        // Asignamos a cada variable su valor

        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $producto = $_POST["tipo"];
        $cantidad = $_POST["cantidad"];

        // Una vez pulsado el botón podemos empezar a operar

        if (isset($_POST['confirmar'])) {

            // Aqui creariamos el ciente con sus variables y comprariamos el producto pero no me da tiempo

        }
    }


    ?>

        <h3>Producto Comprado</h3>


        <h3>Resumen de Compra</h3>
        <p><strong>Cantidad comprada:</strong>  unidades</p>

        <h3>Control de Stock</h3>
        <p><strong>Stock antes de la compra:</strong>  unidades</p>
        <p><strong>Stock después de la compra:</strong>  unidades</p>
        <p><strong>Unidades vendidas:</strong> </p>

        <h3>Estadísticas Globales</h3>
        <p><strong>Total productos:</strong> </p>
        <p><strong>Total hardware:</strong> </p>
        <p><strong>Total software:</strong> </p>

        // Mostrar devoluciones de hardware si existen (usando métodos mágicos)

            <h3>Devoluciones al Proveedor (Hardware)</h3>

</body>
</html>