<?php

require_once("cliente.php");
require_once("papel.php");
require_once("fotocopia.php");
require_once("libro.php");

$p1 = new cliente("Pepe");
$fc1 = new fotocopia(10,20,true);
$supercicie1 = $fc1->calcularEspacio();
echo $supercicie1;
echo "<br>";
$p1->comprar($fc1);
echo $fc1;
echo "<br>";
echo $fc1->getPaginasGastadas();
echo "<br>";
echo $fc1->getPaginasRecicladas();
echo "<br>";
echo $p1->getClientela();
echo "<br>";
unset($p1);
unset($fc1);
echo papel::$paginasGastadas;
echo "<br>";
echo papel::$paginasRecicladas;
echo "<br>";
echo cliente::getClientela();
echo "<br>";
$l1 = new libro(12,25,true,200);
$l1->titulo = "Titulo";
$l1->embalar(2);
$p2 = new cliente("Juan");
$p2->comprar($l1);
echo papel::$paginasGastadas;
echo "<br>";
echo papel::$paginasRecicladas;
echo "<br>";
echo cliente::getClientela();
echo "<br>";





?>