<?php
include_once('clases.php');
include_once('funciones.php');

session_start();

/**
 * PRINCIPAL.PHP (corregido y estructurado)
 */

// 1) Verificar cookie / sesión (según examen: cookie "id")
if (!isset($_COOKIE['id'])) {
    header('Location: index.php');
    exit;
}

// Renovar cookie 30s
setcookie('id', $_COOKIE['id'], time() + 30);

// 2) Inicializar variables base
$id_cliente = $_COOKIE['id'];

// (NO TOCAR) Tipo seleccionado: normal por defecto o el enviado
$tipo_seleccionado = isset($_POST['tipo']) ? $_POST['tipo'] : 'normal';

// Crear fichero/estructura del cliente si no existe
obtenerArchivoCliente($id_cliente);

// Mensaje (opcional)
$mensaje = '';
if (isset($_SESSION['mensaje'])) {
    $mensaje = (string)$_SESSION['mensaje'];
    unset($_SESSION['mensaje']); // se muestra una vez
}

// 3) Procesar POST (acciones)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 3.1) Cambiar tipo (solo actualizar variable)
    if (isset($_POST['cambiarTipo'])) {
        $tipo_seleccionado = $_POST['tipo'] ?? 'normal';
    }

    // 3.2) Registrar nuevo paquete
    if (isset($_POST['nuevoPaquete'])) {

        // Leer campos SOLO aquí (evita undefined cuando se pulsa "Seleccionar tipo")
        $id      = generarIdPaquete();
        $peso    = $_POST['peso'] ?? null;
        $destino = $_POST['destino'] ?? '';
        $fecha   = $_POST['fecha_envio'] ?? date('Y-m-d');
        $detalle = $_POST['detalle'] ?? '';
        $detalle = (int)$detalle;

        // Validaciones mínimas (opcional, pero recomendable)
        if ($peso === null || $peso === '' || (float)$peso <= 0) {
            $mensaje = 'El peso debe ser mayor que 0.';
        } elseif (trim($destino) === '') {
            $mensaje = 'El destino es obligatorio.';
        } else {

            // Crear objeto según tipo
            switch ($tipo_seleccionado) {
                case 'normal':
                    $p = new Paquete($id, $peso, $destino, $fecha);
                    break;

                case 'urgente':
                    $p = new PaqueteUrgente($id, $peso, $destino, $fecha, $detalle);
                    break;

                case 'fragil':
                    $p = new PaqueteFragil($id, $peso, $destino, $fecha, $detalle);
                    break;

                default:
                    $p = null;
                    $mensaje = 'Tipo de paquete no válido.';
                    break;
            }

            if ($p !== null) {
                // Guardar paquete
                anadirPaquete($id_cliente, $p);
                $mensaje = 'Paquete registrado correctamente.';
            }
        }
    }

    // 3.3) Cerrar sesión
    if (isset($_POST['cerrar'])) {
        setcookie('id', $_COOKIE['id'], time() - 3600);
        header('Location: index.php');
        exit;
    }
}

// 4) Obtener paquetes SIEMPRE (GET o POST)
$paquetes = leerPaquetes($id_cliente);

// 5) Calcular coste total
$coste_total = calcularCosteTotal($paquetes);

// (NO TOCAR) Fecha por defecto para el input date
$fecha_hoy = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Paquetería - Panel Principal</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Bienvenido, Cliente <?= htmlspecialchars($id_cliente) ?></h1>
        <form method="post">
            <input type="submit" name="cerrar" value="Cerrar sesión" class="logout">
        </form>
    </div>

    <!-- MOSTRAR MENSAJE, SI HAY -->
    <?php if ($mensaje !== ''): ?>
        <div class="message"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <!-- NO TOCAR ESTE FORMULARIO (INICIO)-->
    <h2>Seleccionar Tipo de Paquete</h2>
    <form method="POST">
        <div class="form-row">
            <label for="tipo">Tipo de paquete:</label>
            <select name="tipo" id="tipo">
                <option value="normal"  <?= ($tipo_seleccionado === 'normal') ? 'selected' : ''; ?>>Normal</option>
                <option value="urgente" <?= ($tipo_seleccionado === 'urgente') ? 'selected' : ''; ?>>Urgente</option>
                <option value="fragil"  <?= ($tipo_seleccionado === 'fragil') ? 'selected' : ''; ?>>Frágil</option>
            </select>
            <input type="submit" name="cambiarTipo" value="Seleccionar">
        </div>
    </form>
    <!-- NO TOCAR ESTE FORMULARIO (FIN)-->

    <h2>Registrar Nuevo Paquete (<?= htmlspecialchars($tipo_seleccionado) ?>)</h2>
    <form method="POST">
        <!-- Mantener el tipo al registrar -->
        <input type="hidden" name="tipo" value="<?= htmlspecialchars($tipo_seleccionado) ?>">

        <table border="0">
            <tr>
                <td><label for="peso">Peso (kg):</label></td>
                <td><input type="number" id="peso" name="peso" step="0.01" min="0.01" required></td>
            </tr>
            <tr>
                <td><label for="destino">Destino:</label></td>
                <td><input type="text" id="destino" name="destino" required></td>
            </tr>
            <tr>
                <td><label for="fecha_envio">Fecha de envío:</label></td>
                <td><input type="date" id="fecha_envio" name="fecha_envio" value="<?= htmlspecialchars($fecha_hoy) ?>" required></td>
            </tr>

            <?php if ($tipo_seleccionado !== 'normal'): ?>
                <tr>
                    <td>
                        <label for="detalle">
                            <?= ($tipo_seleccionado === 'urgente') ? 'Detalle (urgente)' : 'Detalle (frágil)' ?>
                        </label>
                    </td>
                    <td><input type="text" id="detalle" name="detalle" required></td>
                </tr>
            <?php endif; ?>

            <tr>
                <td colspan="2">
                    <input type="submit" name="nuevoPaquete" value="Registrar Paquete">
                </td>
            </tr>
        </table>
    </form>

    <h2>Mis Paquetes (Coste total: <?= number_format((float)$coste_total, 2, ',', '.') ?> €)</h2>

    <?php if (empty($paquetes)): ?>
        <p>No hay paquetes registrados.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Peso</th>
                <th>Destino</th>
                <th>Fecha Envío</th>
                <th>Detalles</th>
                <th>Coste</th>
            </tr>

            <?php foreach ($paquetes as $p): ?>
                <?php
                // Tipo real por clase
                $tipo_real = ($p instanceof PaqueteUrgente) ? 'urgente'
                           : (($p instanceof PaqueteFragil) ? 'fragil' : 'normal');

                // Detalle real si existe la propiedad (ajusta nombres si tu clase usa otro)
                $detalle_real = '';
                if (property_exists($p, 'detalle')) {
                    $detalle_real = (string)$p->detalle;
                } elseif (property_exists($p, 'detalles')) {
                    $detalle_real = (string)$p->detalles;
                } elseif (property_exists($p, 'descripcion')) {
                    $detalle_real = (string)$p->descripcion;
                }
                ?>
                <tr>
                    <td><?= htmlspecialchars((string)$p->id) ?></td>
                    <td><?= htmlspecialchars($tipo_real) ?></td>
                    <td><?= htmlspecialchars((string)$p->peso) ?> kg</td>
                    <td><?= htmlspecialchars((string)$p->destino) ?></td>
                    <td><?= htmlspecialchars((string)$p->fecha_envio) ?></td>
                    <td><?= htmlspecialchars($detalle_real) ?></td>
                    <td><?= number_format((float)$p->calcularCoste(), 2, ',', '.') ?> €</td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

</div>
</body>
</html>
