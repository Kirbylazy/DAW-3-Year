<?php
require_once 'clases.php';
require_once 'funciones.php';

// Verificar cookie y renovarla
if (isset($_COOKIE['usuario'])) {
    setcookie('usuario', $_COOKIE['usuario'], time() + 30, "/");
    $dni = $_COOKIE['usuario'];
} else {
    header('Location: index.php');
    exit;
}

// Inicializar archivo del usuario si no existe
$archivo = $dni . '.txt';
if (!file_exists($archivo)) {
    file_put_contents($archivo, '');
}

// Procesar acciones de formularios
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Cerrar sesión
    if (isset($_POST['cerrar'])) {
        setcookie('usuario', '', time() - 3600, "/");
        unset($_COOKIE['usuario']);
        header('Location: index.php');
        exit;
    }

    // Agregar movimiento
    if (isset($_POST['nuevoMovimiento'])) {

        $tipo = $_POST['tipo'] ?? '';
        $fecha = $_POST['fecha'] ?? '';
        $concepto = $_POST['concepto'] ?? '';
        $cantidad = (int) ($_POST['cantidad'] ?? 0); // si usas decimales, cámbialo a float
        $desdeHasta = $_POST['desdeHasta'] ?? '';

        if ($tipo === 'gasto') {
            $movimiento = new Gasto($fecha, $concepto, $cantidad, $desdeHasta);
            anadirMovimiento($dni, $movimiento);

        } elseif ($tipo === 'ingreso') {
            $movimiento = new Ingreso($fecha, $concepto, $cantidad, $desdeHasta);
            anadirMovimiento($dni, $movimiento);
        }
    }
}

// Obtener movimientos
$movimientos = leerMovimientos($dni);

// Calcular saldo
$saldo = 0;
foreach ($movimientos as $m) {
    if ($m instanceof Gasto) {
        $saldo -= $m->cantidad;
    } elseif ($m instanceof Ingreso) {
        $saldo += $m->cantidad;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Banco - Principal</title>
</head>
<body>

    <h1>Bienvenido, <?= $dni ?></h1>

    <!-- Botón cerrar sesión -->
    <form method="post">
        <input type="submit" name="cerrar" value="Cerrar sesión">
    </form>

    <h2>Añadir nuevo movimiento</h2>

    <!-- Formulario de añadir (UN SOLO FORM) -->
    <form method="post">
        <table border="0">
            <tr>
                <td><label for="tipo">Tipo de movimiento:</label></td>
                <td>
                    <select name="tipo" id="tipo">
                        <option value="gasto">Gasto</option>
                        <option value="ingreso">Ingreso</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="fecha">Fecha:</label></td>
                <td><input type="date" id="fecha" name="fecha" required></td>
            </tr>
            <tr>
                <td><label for="concepto">Concepto:</label></td>
                <td><input type="text" id="concepto" name="concepto" required></td>
            </tr>
            <tr>
                <td><label for="cantidad">Cantidad (€):</label></td>
                <td><input type="number" id="cantidad" name="cantidad" required></td>
            </tr>
            <tr>
                <td><label for="desdeHasta">Desde/hacia (persona)</label></td>
                <td><input type="text" id="desdeHasta" name="desdeHasta"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="nuevoMovimiento" value="Añadir">
                </td>
            </tr>
        </table>
    </form>

    <h2>Movimientos (Saldo actual: <?= $saldo ?>€)</h2>

    <?php if (empty($movimientos)) { ?>
        <p>No hay movimientos registrados.</p>
    <?php } else { ?>
        <table border="1">
            <tr>
                <th>Tipo</th>
                <th>Fecha</th>
                <th>Concepto</th>
                <th>Cantidad</th>
                <th>Detalles</th>
            </tr>
            <?php foreach ($movimientos as $m) { ?>
                <tr>
                    <td><?= get_class($m) ?></td>
                    <td><?= $m->fecha ?></td>
                    <td><?= $m->concepto ?></td>
                    <td><?= $m->cantidad ?>€</td>
                    <td>
                        <?php
                        if ($m instanceof Gasto) {
                            echo "Origen: " . $m->origen;
                        } elseif ($m instanceof Ingreso) {
                            echo "Destinatario: " . $m->destinatario;
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>

</body>
</html>
