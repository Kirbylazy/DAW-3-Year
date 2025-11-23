<?php
require_once("vehiculo.php");
require_once("coche.php");

echo "<h1>Pruebas de la clase Vehiculo y Coche</h1>";

/* ============================
   PRUEBAS DE LA CLASE VEHICULO
   ============================ */
echo "<h2>Pruebas de Vehículo</h2>";

$bici = new vehiculo("Orbea", "Rojo");
$moto = new vehiculo("Yamaha", "Negra");
$camion = new vehiculo("Volvo", "Blanco");
$patinete = new vehiculo("Xiaomi", "Gris");

// Asignar plazas
$bici->setPlazas(1);
$moto->setPlazas(2);
$camion->setPlazas(5);
$patinete->setPlazas(1);

// Mostrar información inicial
echo "<h3>Estado inicial</h3>";
echo "<p>$bici</p>";
echo "<p>$moto</p>";
echo "<p>$camion</p>";
echo "<p>$patinete</p>";

// Probar métodos
echo "<h3>Probando métodos</h3>";
$moto->arrancar();
$camion->arrancar();

echo "<p><strong>Después de arrancar moto y camión:</strong></p>";
echo "<p>$bici</p>";
echo "<p>$moto</p>";
echo "<p>$camion</p>";
echo "<p>$patinete</p>";

// Comprobamos el método isAparcado()
echo "<h3>Comprobando método isAparcado()</h3>";
echo "<p>¿La bici está aparcada? " . ($bici->isAparcado() ? "Sí" : "No") . "</p>";
echo "<p>¿La moto está aparcada? " . ($moto->isAparcado() ? "Sí" : "No") . "</p>";

// Probamos setPlazas con valor no válido
echo "<h3>Prueba de control de plazas</h3>";
$resultado = $camion->setPlazas(-4);
echo $resultado ? "<p>Plazas asignadas correctamente.</p>" : "<p>Valor inválido. Plazas ajustadas a 0.</p>";
echo "<p>$camion</p>";


/* ============================
   PRUEBAS DE LA CLASE COCHE
   ============================ */
echo "<h2>Pruebas de Coche</h2>";

// Crear coches con matrículas válidas e inválidas
$coche1 = new coche("1234 BCD");  // válida
$coche2 = new coche("1234 AEI");  // inválida (vocales)
$coche3 = new coche("5678 XYZ");  // válida

// Asignar algunos atributos heredados
$coche1->setMarca("Seat");
$coche1->setColor("Rojo");
$coche1->setPlazas(5);

$coche3->setMarca("Ford");
$coche3->setColor("Azul");
$coche3->setPlazas(4);

// Mostrar resultados
echo "<h3>Comprobando matrículas</h3>";
echo "<p>Matrícula '1234 BCD' válida → " . ($coche1->getMatricula() ?: "no asignada") . "</p>";
echo "<p>Matrícula '1234 AEI' inválida → " . ($coche2->getMatricula() ?: "no asignada") . "</p>";
echo "<p>Matrícula '5678 XYZ' válida → " . ($coche3->getMatricula() ?: "no asignada") . "</p>";

// Probar el método viajar
echo "<h3>Probando viajar()</h3>";
$coche1->arrancar();
$coche1->viajar(120);
$coche1->viajar(80);

$coche3->viajar(200); // No arranca → no debería sumar km

echo "<p>$coche1</p>";
echo "<p>$coche3</p>";

?>
