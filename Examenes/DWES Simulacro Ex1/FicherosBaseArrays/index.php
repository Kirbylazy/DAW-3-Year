<?php

include "funciones.php";
$mensaje = jugarPartida(4);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Turnos</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        th {
            background: #333;
            color: white;
            padding: 12px;
            text-transform: uppercase;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background: #f0f0f0;
        }

        tr:hover {
            background: #d7ebff;
        }
    </style>
</head>
<body>

<h1>Historial de Turnos del Juego</h1>

<?php
    // EJEMPLO: Ejecutas tu partida antes de la tabla
    // $mensaje = jugarPartida(4);

    // Asegurarte de que existe $mensaje
    if (!isset($mensaje)) {
        echo "<p style='text-align:center;color:red;'>No existe el array \$mensaje. Debes llamarlo antes.</p>";
    } else {
?>
    <table>
        <thead>
            <tr>
                <th>Turno</th>
                <th>Mensaje</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($mensaje as $index => $texto): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $texto; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php } ?>

</body>
</html>
