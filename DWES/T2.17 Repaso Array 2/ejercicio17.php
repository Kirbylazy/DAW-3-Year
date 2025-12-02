<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 17 - Idiomas adicionales entre clientes</title>
</head>
<body>
    <h1>Ejercicio 17: Idiomas adicionales entre clientes</h1>

    <form method="POST">
        <label for="idCliente1">Cliente 1:</label>
        <select name="idCliente1" id="idCliente1" required>
            <option value="">-- Selecciona cliente 1 --</option>
            <!-- TODO: Generar opciones dinamicamente con obtenerIdsClientesAux() -->
        </select>
        <br><br>
        <label for="idCliente2">Cliente 2:</label>
        <select name="idCliente2" id="idCliente2" required>
            <option value="">-- Selecciona cliente 2 --</option>
            <!-- TODO: Generar opciones dinamicamente con obtenerIdsClientesAux() -->
        </select>
        <br><br>
        <button type="submit" name="submit">Ejecutar</button>
    </form>

    <!-- TODO: Mostrar resultado cuando se envie el formulario -->
    <!-- Debe mostrar cuantos idiomas adicionales habla cliente1 respecto a cliente2 -->
</body>
</html>
