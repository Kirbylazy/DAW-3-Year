<?php

// Ejercicio 5 - Países
// Crea un array de claves valores de países con la siguiente información de cada país:
// ● Capital
// ● Población aproximada
// ● Idiomas principales de ese país
// ● ¿Si tiene costa?

// A continuación, en un formulario, haz una página con un menú desplegable y un botón "Ver". 
// En el desplegable, deben visualizarse los países, y al pulsar el botón ver, mostrar su información.


$paises = [
    "España" => [
        "capital" => "Madrid",
        "poblacion" => "47 millones",
        "idiomas" => ["Español", "Catalán", "Gallego", "Euskera"],
        "tiene_costa" => "Sí"
    ],
    "Francia" => [
        "capital" => "París",
        "poblacion" => "67 millones",
        "idiomas" => ["Francés"],
        "tiene_costa" => "Sí"
    ],
    "Alemania" => [
        "capital" => "Berlín",
        "poblacion" => "83 millones",
        "idiomas" => ["Alemán"],
        "tiene_costa" => "Sí"
    ],
    "Italia" => [
        "capital" => "Roma",
        "poblacion" => "60 millones",
        "idiomas" => ["Italiano"],
        "tiene_costa" => "Sí"
    ],
    "Suiza" => [
        "capital" => "Berna",
        "poblacion" => "8.7 millones",
        "idiomas" => ["Alemán", "Francés", "Italiano", "Romanche"],
        "tiene_costa" => "No"
    ]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Países</title>
</head>
<body>

<h2>Información de Países</h2>

<form method="post">
    <label for="pais">Elige un país:</label>
    <select id="pais" name="pais">
        <option value="España">España</option>
        <option value="Francia">Francia</option>
        <option value="Alemania">Alemania</option>
        <option value="Italia">Italia</option>
        <option value="Suiza">Suiza</option>
    </select>
    <button type="submit" name="confirmar">Ver</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar'])) {
    $pais = $_POST["pais"];
?>
<table border="1">
    <tr>
        <th colspan="2">Datos de <?= $pais ?></th>
    </tr>
    <tr>
        <th>Capital</th>
        <td><?= $paises[$pais]["capital"] ?></td>
    </tr>
    <tr>
        <th>Población</th>
        <td><?= $paises[$pais]["poblacion"] ?></td>
    </tr>
    <tr>
        <th>Idiomas</th>
        <td><?= implode(", ", $paises[$pais]["idiomas"]) ?></td>
    </tr>
    <tr>
        <th>¿Tiene costa?</th>
        <td><?= $paises[$pais]["tiene_costa"] ?></td>
    </tr>
</table>
<?php } ?>

</body>
</html>
