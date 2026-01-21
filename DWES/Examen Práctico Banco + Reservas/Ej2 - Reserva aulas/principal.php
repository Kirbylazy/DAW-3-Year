<?php
include_once('funciones.php');
session_start();

// Verificar que el usuario esté autenticado o se vuelva a index

if(!isset($_SESSION['id'])){

    header('Location: index.php');
    exit;

}

// Procesamiento de acciones POST (puedes programarlo aquí o llamar a las funciones)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Cerrar sesión
    if(isset($_POST['logout'])){

        $_SESSION =  [];
        session_destroy();
        header('Location: index.php');
        exit;

    }

    // Crear nueva reserva
    if(isset($_POST['crear_reserva'])){

    crearReserva($_SESSION['id'], $_POST['aula_id'], $_POST['fecha'], 
                    $_POST['motivo']);
    }

    // Eliminar reserva
    if(isset($_POST['eliminar'])){

        $reserva_id = (int)$_POST['eliminar'];
        eliminarReserva($reserva_id, $_SESSION['id']);

    }

    // Cambiar estado de reserva
    if (isset($_POST['cambiar_estado'])) {

        $reserva_id = (int)$_POST['cambiar_estado'];
        cambiarEstadoReserva($reserva_id, $_SESSION['id']);

    }
}


// Obtener aulas para el select list, funcion obteneraulas
$aulas = obtenerAulas();
// Obtener reservas, para mostrar en la tabla, funcion obtenerReservas
$reservas = obtenerReservas($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sistema de Reservas de Aulas</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>

<body>
    <table>
        <tr>
            <th colspan="2">Sistema de Reservas de Aulas</th>
        </tr>
        <tr>
            <td colspan="2">
                Bienvenido, <?= $_SESSION['nombre'] ?>
                <form method="post" action="">
                    <input type="submit" name="logout" value="Cerrar sesión">
                </form>
            </td>
        </tr>
    </table>

    <!-- MENSAJES INFORMATIVOS -->


    <!-- Formulario para crear reserva -->
    <form method="post" action="">
        <table>
            <tr>
                <th colspan="2">Nueva Reserva</th>
            </tr>
            <tr>
                <td><label for="aula_id">Aula:</label></td>
                <td>
                    <select id="aula_id" name="aula_id" required>
                        <option value="">Seleccione un aula</option>
                        <!-- AÑADIR UNA OPCION POR CADA AULA LIBRE-->
                         <?php foreach ($aulas as $aula): ?>
                        <option value="<?= (int)$aula['id'] ?>">
                            <?= $aula['nombre'] ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="fecha">Fecha:</label></td>
                <td>
                    <input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>">
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
                    <input type="submit" name="crear_reserva" value="Crear Reserva">
                </td>
            </tr>
        </table>
    </form>

    <!-- Listado de reservas -->
    <table>
        <tr>
            <th colspan="5">Mis Reservas</th>
        </tr>
        <?php if (empty($reservas)): ?>
            <tr>
                <td>No tienes reservas actualmente.</td>
            </tr>
        <?php else: ?>
            <tr>
                <th>Aula</th>
                <th>Fecha</th>
                <th>Motivo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($reservas as $r): ?>
                <tr>
                    <td><?= $r['aula_nombre'] ?></td>
                    <td><?= $r['fecha'] ?></td>
                    <td><?= $r['motivo'] ?></td>
                    <td><?= ($r['reservada'] === 1) ? 'Reservada' : 'Terminada' ?></td>
                    <td>
                        <!-- SI ESTÁ RESERVADA MUESTRA LOS BOTONES. -->
                        <?php if ($r['reservada'] === 1): ?>
                            <form method="post" action="">
                            <button type="submit" name="cambiar_estado" value="<?= $r['id'] ?>">Terminar</button>
                            <button type="submit" name="eliminar" value="<?= $r['id']?>" >Eliminar</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif ?>
    </table>
</body>

</html>