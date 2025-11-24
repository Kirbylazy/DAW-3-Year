<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Reloj - Juego de Cartas</title>
    <style>
        table {
            border-collapse: collapse;
            margin: 20px 0;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #ddd;
        }
    </style>
</head>

<body>

    <!-- Mostrar el desarrollo del juego, si se ha pulsado el botón -->

    // Recibir parámetros del formulario

    // Ejecutar la partida

    // Extraer datos del resultado

    // Mostrar resultados

    <h1>El Reloj - Resultados de la Partida</h1>

    <p><strong>Nº de Jugadores:</strong></p>
    <p><strong>Cartas jugadas:</strong></p>

    <hr>

    <h2>Desarrollo del Juego</h2>
    <table>
        <thead>
            <tr>
                <th>Jugador</th>
                <th>Valor Enunciado</th>
                <th>Carta que Salió</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <hr>

    <h2>🏆 GANADOR: </h2>
    <h2>🤝 EMPATE entre: </h2>

    <p>
        <a href="index.php"><button>Volver a Jugar</button></a>
    </p>

    <hr>


    <!-- Mostrar formulario inicial si no se ha pulsado ningún botón -->

    <h1>El Reloj - Juego de Cartas</h1>

    <h2>Descripción del Juego</h2>
    <p>
        <strong>El Reloj</strong> es un juego de azar con baraja española donde los jugadores
        enuncian valores en secuencia y van recibiendo cartas. Si la carta que sale coincide
        con el valor enunciado, el jugador queda <u>eliminado</u>.
    </p>

    <h3>Reglas:</h3>
    <ul>
        <li>La secuencia de enunciación es: <strong>1, 2, 3, 4, 5, 6, 7, Sota, Caballo, Rey</strong></li>
        <li>Después del Rey se vuelve a empezar desde el 1</li>
        <li>Si dices "1" y sale un As (1), quedas eliminado</li>
        <li>Si dices "5" y sale un 5, quedas eliminado</li>
        <li>Si dices "Rey" y sale un Rey, quedas eliminado</li>
        <li>El último jugador que quede en pie es el <strong>ganador</strong></li>
    </ul>

    <hr>

    <h2>Configuración de la Partida</h2>
    <!-- Formulario de entrada -->



</body>

</html>