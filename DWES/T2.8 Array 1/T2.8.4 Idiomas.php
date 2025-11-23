<?php

// Ejercicio 4 - Diccionario de meses
// Escribe un programa php que muestre una página con un desplegable que muestre el "idioma origen" y otro el "idioma destino". 
// Al pulsar el botón traducir, debe mostrar Una tabla con dos columnas, una con los meses en idioma de origen, y otra, traducido.



// Construimos todos los arrays con los meses

$español = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

$ingles = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

$frances = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];

$aleman = ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"];

?>

<!-- Construimos la pagina a mostrar en html -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Idiomas</title>
</head>
<body>
    <h2>Meses del año</h2>

    <!-- Creamos un formulario para recoger todos los datos -->

    <form method="post" action="">

        <!-- Creamos el desplegable de opciones para el primer idioma -->
        
        <label for="idioma1"><br><br>Elige un idioma:</label>
            <select id="idioma1" name="idioma1">
            <option value="español">Español</option>
            <option value="ingles">Ingles</option>
            <option value="frances">Frances</option>
            <option value="aleman">Aleman</option>
            </select>

        <!-- Creamos el desplegable de opciones para el segundo idioma -->
        
        <label for="idioma2"><br><br>Elige otro idioma:</label>
            <select id="idioma2" name="idioma2">
            <option value="español">Español</option>
            <option value="ingles">Ingles</option>
            <option value="frances">Frances</option>
            <option value="aleman">Aleman</option>
            </select>

        <!-- Creamos el botón para confirma que se puede realizar la traduccion -->

        <button type="submit" name="confirmar">Traducir</button>
        <p><br></p>

    </form>

    <?php

    // Recogemos todos los datos desde el post

    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        // Asignamos a cada variable su valor

        $idioma1 = $_POST["idioma1"];
        $idioma2 = $_POST["idioma2"];

        // Una vez pulsado el botón podemos empezar a operar

        if (isset($_POST['confirmar'])) {

    ?>

    <!-- Cramos la tabla para mostrar los meses -->

    <table border="1">
        <tr>
            <th colspan="2"> Traducción de meses </th>
        </tr>
        <tr>
            <th> <?= $idioma1 ?> </th><th> <?= $idioma2 ?> </th>
        </tr>
        <?php for ($i = 1; $i <= 12; $i++) :
        $mes1 = ${"$idioma1"}[$i-1]; 
        $mes2 = ${"$idioma2"}[$i-1];
        ?>
        <tr>
            <td> <?= $mes1 ?> </td><td> <?= $mes2 ?> </td>
        </tr>
        <?php endfor;?>
    </table>

    <?php    }
    }
    ?>

</body>
</html>