<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Biblioteca</title>
    <style>
        body {
            font-family: Arial;
            margin: 20px;
        }

        h1,
        h2,
        h3 {
            color: #333;
        }

        .mensaje {
            background: #f0f0f0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        form {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin: 5px 0;
        }

        input,
        select {
            margin-bottom: 10px;
        }

        .formulario {
            border: 1px solid #000;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h1>Biblioteca</h1>

    <div class="mensaje"><!-- Mensaje de estado--></div>

    <!-- Selector de tipo de material -->
    <h2>Añadir Material</h2>
    <form method="post">
        <label>Tipo de material:</label>
        <select name="tipo" onchange="this.form.submit()">
            <option value="libro">Libro</option>
            <option value="revista">Revista</option>
        </select>
    </form>

    <!-- Formulario específico según el tipo seleccionado -->
    <div class="formulario">

        <!-- Formulario para libros -->
        <form method="post">
            <h3>Añadir Libro</h3>

            <label>ISBN:</label>
            <input type="text" name="isbn" required>

            <label>Título:</label>
            <input type="text" name="titulo" required>

            <label>Autor:</label>
            <input type="text" name="autor" required>

            <button type="submit" name="añadir_libro">Añadir Libro</button>
        </form>

        <!-- Formulario para revistas -->
        <form method="post">
            <h3>Añadir Revista</h3>

            <label>ISSN:</label>
            <input type="text" name="issn" required>

            <label>Título:</label>
            <input type="text" name="titulo" required>

            <label>Número:</label>
            <input type="text" name="numero" required>

            <button type="submit" name="añadir_revista">Añadir Revista</button>
        </form>


        // Mensaje de la última acción realizada


        ?>
    </div>

    <!-- Lista de materiales -->
    <h2>Materiales Disponibles</h2>
    <?php if (empty($materiales)): ?>
        <p>No hay materiales en la biblioteca.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Tipo</th>
                <th>Identificador</th>
                <th>Título</th>
                <th>Detalles</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>


            <tr>

                <td> </td>

                <td> </td>

                <td> </td>

                <td> </td>
                <td> </td>
                <td>
                    <form method="post" style="display: inline; margin: 0;">
                        <button type="submit" name="cambiar" >Cambiar disponibilidad</button>
                        <button type="submit" name="consultar" >Consultar</button>
                        <button type="submit" name="borrar" >Borrar</button>
                    </form>
                </td>
            </tr>



        </table>
    <?php endif; ?>
</body>

</html>