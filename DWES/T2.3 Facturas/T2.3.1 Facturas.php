<?php

// Define constantes para:

// IVA (21%)
// Descuento (15%)
// Portes fijos (5€)
// Calcula el total de una factura con precio base, aplicando IVA en %, aplicando descuento en % y sumando portes. 
// Muestra desglose completo.

// Fórmula (precio base - descuentos + portes, y luego IVA).

const IVA = 1.21;
const DESCUENTO = 0.85;
const PORTES = 5;

$importe = 0;
$mensaje = "";
$mensaje2 = "";

?>

<!-- Construimos la pagina a mostrar en html -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Facturas</title>
</head>
<body>
    <h2>Calculo de facturas</h2>

    <!-- Creamos un formulario para recoger todos los datos -->

    <form method="post" action="">

        <!-- Pedimos el importe de la factura -->

        <label for="importe">Importe de la Factura:</label> 
        <input type="number" name="importe" id="importe" required>

        <!-- Creamos el botón para confirmar -->

        <button type="submit" name="confirmar">Enviar</button>
        <p><br></p>

    </form>

<?php

// Recogemos todos los datos desde el post

    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        // Asignamos a cada variable su valor

        $importe = $_POST["importe"];

        // Una vez pulsado el botón podemos empezar a operar

        if (isset($_POST['confirmar'])) {

            // Hacemos todos los calculos necesarios.

            $iva = IVA * $importe;
            $descuento = DESCUENTO * $iva;
            $portes = PORTES + $descuento;
            $importe = number_format($importe, 2);
            $mensaje .= "El importe a facturar es <b>$importe €</b><br>";
            $iva = number_format($iva, 2);
            $mensaje .= "El importe con IVA es <b>$iva €</b><br>";
            $descuento = number_format($descuento, 2);
            $mensaje .= "El importe aplicando el descuento es <b>$descuento €</b><br>";
            $portes = number_format($portes, 2);
            $mensaje .= "El importe mas los portes es <b>$portes €</b><br>";
            $mensaje2 .="El importe total a pagar es <b>$portes €</b>";

        }
    ?>

        <p><?= $mensaje ?></p>
        <h2><?= $mensaje2 ?></h2>
    </body>
    </html>
<?php
    }
?>


    




