<?php
require_once('clases.php');

session_start();

if (!isset($_SESSION['usuario']) || isset($_POST['cerrar']) ){
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
}

$usuario = $_SESSION['usuario'];

echo "<h1>Hola, {$usuario->getNombre()}</h1>";
echo "<h2>Tus notas:</h2>";

if (empty($usuario->getNotas())) {
    echo "No tienes notas asignadas.";
} else {
    echo "<ul>";
    foreach ($usuario->getNotas() as $asignatura => $nota) {
        echo "<li>$asignatura: $nota</li>";
    }
    echo "</ul>";
}

?>

<form method="POST">
    <button type="submit" name="cerrar" >Cerrar</button>
</form>
