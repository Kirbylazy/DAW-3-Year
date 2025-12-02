<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 7 - Idiomas por nivel de un cliente</title>
</head>
<body>
    <h1>Ejercicio 7: Idiomas por nivel de un cliente</h1>

    <form method="POST">
        <label for="idCliente">ID Cliente:</label>
        <select name="idCliente" id="idCliente" required>
            <option value="">-- Selecciona un cliente --</option>
            <!-- TODO: Generar opciones dinamicamente con obtenerIdsClientesAux() -->
        </select>
        <br><br>
        <label for="nivel">Nivel:</label>
        <input type="text" name="nivel" id="nivel" placeholder="Ej: nativo, C1, B2, A2" required>
        <br><br>
        <button type="submit" name="submit">Ejecutar</button>
    </form>

    <!-- TODO: Mostrar resultado cuando se envie el formulario -->
    <!-- Debe mostrar lista de idiomas del cliente con ese nivel -->
    <!-- Debe mostrar tabla con todos los idiomas del cliente para contexto -->
</body>
</html>
