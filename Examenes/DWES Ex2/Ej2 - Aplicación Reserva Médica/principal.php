<?php
session_start();
include_once('funciones.php');

// Verificar que el usuario esté autenticado o se vuelva a index
if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit;
}

// Mensaje (flash)
$mensaje = '';
if (isset($_SESSION['mensaje']) && $_SESSION['mensaje'] !== '') {
    $mensaje = (string)$_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
}

// Procesamiento de acciones POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Cerrar sesión
    if (isset($_POST['logout'])) {
        $_SESSION = [];
        session_destroy();
        header('Location: index.php');
        exit;
    }

    // Crear nueva cita
    if (isset($_POST['crear_cita'])) {
        $medico_id = $_POST['medico_id'] ?? '';
        $fecha     = $_POST['fecha'] ?? date('Y-m-d');
        $motivo    = $_POST['motivo'] ?? '';

        crearCita($_SESSION['id'], $medico_id, $fecha, $motivo);
        // crearCita() ya deja mensaje en $_SESSION['mensaje']
        header('Location: principal.php');
        exit;
    }

    // Cancelar cita
    if (isset($_POST['cancelar'])) {
        $cita_id = (int)($_POST['cancelar'] ?? 0);
        if ($cita_id > 0) {
            cancelarCita($cita_id, $_SESSION['id']);
        }
        header('Location: principal.php');
        exit;
    }

    // Cambiar estado de cita (Atender)
    if (isset($_POST['cambiar_estado'])) {
        $cita_id = (int)($_POST['cambiar_estado'] ?? 0);
        if ($cita_id > 0) {
            cambiarEstadoCita($cita_id, $_SESSION['id']);
        }
        header('Location: principal.php');
        exit;
    }
}

// Obtener médicos para el select list (SIEMPRE)
$medicos = obtenerMedicos();

// Obtener citas, para mostrar en la tabla (SIEMPRE)
$citas = obtenerCitas($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestión de Citas Médicas</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <table>
        <tr>
            <th colspan="2">Sistema de Gestión de Citas Médicas</th>
        </tr>
        <tr>
            <td colspan="2">
                Bienvenido, <?= htmlspecialchars($_SESSION['nombre']) ?>
                <form method="post" action="">
                    <input type="submit" name="logout" value="Cerrar sesión">
                </form>
            </td>
        </tr>
    </table>

    <!-- MENSAJES INFORMATIVOS -->
    <?php if ($mensaje !== ''): ?>
        <table class="mensaje">
            <tr>
                <td><?= htmlspecialchars($mensaje) ?></td>
            </tr>
        </table>
    <?php endif; ?>

    <!-- Formulario para crear cita -->
    <form method="post" action="">
        <table>
            <tr>
                <th colspan="2">Nueva Cita</th>
            </tr>
            <tr>
                <td><label for="medico_id">Médico:</label></td>
                <td>
                    <select id="medico_id" name="medico_id" required>
                        <option value="">Seleccione un médico</option>
                        <?php foreach ($medicos as $m): ?>
                            <option value="<?= (int)$m['id'] ?>">
                                <?= htmlspecialchars($m['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="fecha">Fecha:</label></td>
                <td>
                    <input type="date" id="fecha" name="fecha" value="<?= htmlspecialchars(date('Y-m-d')) ?>" required>
                </td>
            </tr>
            <tr>
                <td><label for="motivo">Motivo:</label></td>
                <td>
                    <textarea id="motivo" name="motivo" required></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="crear_cita" value="Solicitar Cita">
                </td>
            </tr>
        </table>
    </form>

    <!-- Listado de citas -->
    <table>
        <tr>
            <th colspan="7">Mis Citas</th>
        </tr>

        <?php if (empty($citas)): ?>
            <tr>
                <td colspan="7">No tienes citas actualmente.</td>
            </tr>
        <?php else: ?>
            <tr>
                <th>Médico</th>
                <th>Especialidad</th>
                <th>Consulta</th>
                <th>Fecha</th>
                <th>Motivo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>

            <?php foreach ($citas as $c): ?>
                <?php
                // Tu SQL devuelve: medico_nombre, especialidad, consulta, fecha, motivo, activa, id...
                $estado_txt = ((int)$c['activa'] === 1) ? 'Programada' : 'Atendida';
                ?>
                <tr>
                    <td><?= htmlspecialchars($c['medico_nombre']) ?></td>
                    <td><?= htmlspecialchars($c['especialidad']) ?></td>
                    <td><?= htmlspecialchars($c['consulta']) ?></td>
                    <td><?= htmlspecialchars($c['fecha']) ?></td>
                    <td><?= htmlspecialchars($c['motivo']) ?></td>
                    <td><?= htmlspecialchars($estado_txt) ?></td>
                    <td>
                        <?php if ((int)$c['activa'] === 1): ?>
                            <form method="post" action="">
                                <button type="submit" name="cambiar_estado" value="<?= (int)$c['id'] ?>">Atender</button>
                                <button type="submit" name="cancelar" value="<?= (int)$c['id'] ?>">Cancelar</button>
                            </form>
                        <?php else: ?>
                            —
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>


