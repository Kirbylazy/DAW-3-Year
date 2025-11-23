<?php

//      Crea un nuevo fichero (main.php) que importe las clases anteriores y realiza lo siguiente:

// Crea dos arrays, uno de Series y otro de Videojuegos, de 5 posiciones cada uno.
// Crea un objeto en cada posición del array, con los valores que desees
// Entrega algunos Videojuegos y Series con el método entregar().
// Cuenta cuantos Series y Videojuegos hay entregados. Al contarlos, devuélvelos (utiliza el método devolver).
// Indica el videojuego tiene más horas estimadas y la serie con más temporadas.
// Muestra los datos en pantalla con toda su información (usa el método toString()).


require_once("serie.php");
require_once("videojuego.php");

echo "<h1>Pruebas de la clase Serie y Videojuego</h1>";

/* ============================
   PRUEBAS DE LA CLASE SERIE
   ============================ */
echo "<h2>Pruebas de serie</h2>";

$series = [
        $s1 = new serie("Breaking Bad", 5, "Drama / Crimen"),
        $s2 = new serie("Stranger Things", 4, "Ciencia ficción / Misterio"),
        $s3 = new serie("The Office", 9, "Comedia"),
        $s4 = new serie("Game of Thrones", 8, "Fantasía / Drama"),
        $s5 = new serie("The Mandalorian", 3, "Acción / Ciencia ficción")
        ];

// Mostrar información inicial
echo "<h3>Estado inicial</h3>";
echo "<p>$s1</p>";
echo "<p>$s2</p>";
echo "<p>$s3</p>";
echo "<p>$s4</p>";
echo "<p>$s5</p>";

// Asignar plazas
$s1->Entregar();
$s3->Entregar();
$s5->Entregar();

// Mostrar información despues de entregar
echo "<h3>Estado despues de entregar</h3>";
echo "<p>$s1</p>";
echo "<p>$s2</p>";
echo "<p>$s3</p>";
echo "<p>$s4</p>";
echo "<p>$s5</p>";

// Contar entregados
$scontador = 0;
foreach ($series as $s) {
        if ($s->isPrestado())
        {
                $scontador++;
                $s->Devolver();
        }
}

/* ============================
   PRUEBAS DE LA CLASE VIDEOJUEGO
   ============================ */
echo "<h2>Pruebas de Videojuego</h2>";

$videojuegos = [
        $v1 = new Videojuego("The Legend of Zelda: Breath of the Wild", 100, "Aventura / Mundo abierto"),
        $v2 = new Videojuego("Elden Ring", 120, "Acción / RPG"),
        $v3 = new Videojuego("Minecraft", 999, "Sandbox / Supervivencia"),
        $v4 = new Videojuego("Hollow Knight", 40, "Metroidvania / Acción"),
        $v5 = new Videojuego("Super Mario Odyssey", 60, "Plataformas / Aventura")
        ];

// Mostrar información inicial
echo "<h3>Estado inicial</h3>";
echo "<p>$v1</p>";
echo "<p>$v2</p>";
echo "<p>$v3</p>";
echo "<p>$v4</p>";
echo "<p>$v5</p>";

// Asignar plazas
$v1->Entregar();
$v3->Entregar();
$v5->Entregar();

// Mostrar información despues de entregar
echo "<h3>Estado despues de entregar</h3>";
echo "<p>$v1</p>";
echo "<p>$v2</p>";
echo "<p>$v3</p>";
echo "<p>$v4</p>";
echo "<p>$v5</p>";

// Contar entregados
$vcontador = 0;
foreach ($videojuegos as $v) {
        if ($v->isPrestado())
        {
                $vcontador++;
                $v->Devolver();
        }
}

//Mostramos todos los datos
echo "<h3>Series y videojuegos prestados</h3>";
echo "<p>Hay " . $scontador . " series prestadas, y " . $vcontador . " Videojuegos prestados.</p>";
echo "<h3>Serie con más temporadas</h3>";
echo "<p>La serie con más emporadas es: " . serie::$temporadas->getTitulo() . "</p>";
echo "<h3>Videojuego con más horas</h3>";
echo "<p>El videojuego con más horas es: " . videojuego::$horas->getTitulo() . "</p>";

?>