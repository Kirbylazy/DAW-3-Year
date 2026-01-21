<?php

// Verificar que el usuario esté autenticado o se vuelva a index


// Procesamiento de acciones POST (puedes programarlo aquí o llamar a las funciones)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cerrar sesión


    // Crear nueva reserva
   // crearReserva();

    // Eliminar reserva
    //eliminarReserva();

    // Cambiar estado de reserva
    //cambiarEstadoReserva();
}

// Obtener aulas para el select list, funcion obteneraulas
$aulas = "";
// Obtener reservas, para mostrar en la tabla, funcion obtenerReservas
$reservas = "";
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
                Bienvenido, <?php echo "AQUI DEBE SALIR EL NOMBRE" ?>
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




                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="fecha">Fecha:</label></td>
                <td>
                    <input type="date" id="fecha" name="fecha" value="<?php echo date('d-m-Y'); ?>">
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
        <?php if(TRUE):// COMPROBAR SI HAY RESERVAS ?>
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
            <?php // RECORRE LAS RESERVAS ?>
                <tr>
                    <td><?php //IMPRIME NOMBRE DE SALA ?></td>
                    <td><?php //IMPRIME FECHA DE SALA ?></td>
                    <td><?php //IMPRIME MOTIVO DE SALA ?></td>
                    <td><?php //IMPRIMIR SI ESTÁ RESERVADA O TERMINADA?></td>
                    <td>
                        <!-- SI ESTÁ RESERVADA MUESTRA LOS BOTONES. -->
                        <?php if (// ESTA RESERVADA): ?>
                            <form method="post" action="">
                            <button type="submit" name="cambiar_estado" value="<?php //AQUÍ ENVIAIS LA ID?>">Terminar</button>
                            <button type="submit" name="eliminar" value="<?php //AQUÍ ENVIAIS LA ID?>" >Eliminar</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php // HASTA AQUÍ LA TABLA DE RESERVAS ?>
        <?php endif; ?>
    </table>
</body>

</html>