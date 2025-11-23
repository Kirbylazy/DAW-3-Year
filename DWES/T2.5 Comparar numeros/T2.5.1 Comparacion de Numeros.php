<?php

// Realizar la comparación de 3 números introducidos en un formulario:


// a) Con estructura IF
// b) Con estructura Switch



// Vamos a hacer el ejercicio con funciones

//Hacemos una función para imprimir el oreden final
function imprimir_orden($x, $y, $z) {
    echo "Orden de mayor a menor:<br>";
    echo "Primer número: $x<br>";
    echo "Segundo número: $y<br>";
    echo "Tercer número: $z<br>";
}

//Ahora creamos una función para trabajar con if
function resolver_con_if($a, $b, $c) {
    echo "<h3>Resultado (método: IF)</h3>";

    // 1) Tres iguales
    if ($a == $b && $b == $c) {
        echo "Los tres números son iguales.<br>";
        echo "Primer número = Segundo número = Tercer número = $a";
        return;
    }

    // 2) Todos distintos
    if ($a != $b && $a != $c && $b != $c) {
        // A mayor
        if ($a > $b && $a > $c) {
            if ($b > $c) imprimir_orden($a, $b, $c);
            else imprimir_orden($a, $c, $b);
            return;
        }
        // B mayor
        if ($b > $a && $b > $c) {
            if ($a > $c) imprimir_orden($b, $a, $c);
            else imprimir_orden($b, $c, $a);
            return;
        }
        // C mayor
        if ($c > $a && $c > $b) {
            if ($a > $b) imprimir_orden($c, $a, $b);
            else imprimir_orden($c, $b, $a);
            return;
        }
    }

    // 3) Dos iguales y uno distinto
    if ($a == $b) {
        if ($a > $c) {
            echo "A y B son iguales y mayores que C.<br>";
            imprimir_orden($a, $b, $c);
        } else {
            echo "C es mayor; A y B son iguales.<br>";
            imprimir_orden($c, $a, $b);
        }
        return;
    }

    if ($a == $c) {
        if ($a > $b) {
            echo "A y C son iguales y mayores que B.<br>";
            imprimir_orden($a, $c, $b);
        } else {
            echo "B es mayor; A y C son iguales.<br>";
            imprimir_orden($b, $a, $c);
        }
        return;
    }

    if ($b == $c) {
        if ($b > $a) {
            echo "B y C son iguales y mayores que A.<br>";
            imprimir_orden($b, $c, $a);
        } else {
            echo "A es mayor; B y C son iguales.<br>";
            imprimir_orden($a, $b, $c);
        }
        return;
    }
}


//Ahora hacemos una función para trabajar con switch
function resolver_con_switch($a, $b, $c) {
    echo "<h3>Resultado (método: SWITCH)</h3>";

    switch (true) {
        // 1) Tres iguales
        case ($a == $b && $b == $c):
            echo "Los tres números son iguales.<br>";
            echo "Primer número = Segundo número = Tercer número = $a";
            break;

        // 2) Todos distintos
        case ($a != $b && $a != $c && $b != $c):
            // A mayor
            if ($a > $b && $a > $c) {
                if ($b > $c) imprimir_orden($a, $b, $c);
                else imprimir_orden($a, $c, $b);
                break;
            }
            // B mayor
            if ($b > $a && $b > $c) {
                if ($a > $c) imprimir_orden($b, $a, $c);
                else imprimir_orden($b, $c, $a);
                break;
            }
            // C mayor
            if ($c > $a && $c > $b) {
                if ($a > $b) imprimir_orden($c, $a, $b);
                else imprimir_orden($c, $b, $a);
                break;
            }
            break;

        // 3) Dos iguales y uno distinto
        // A = B
        case ($a == $b):
            if ($a > $c) {
                echo "A y B son iguales y mayores que C.<br>";
                imprimir_orden($a, $b, $c);
            } else {
                echo "C es mayor; A y B son iguales.<br>";
                imprimir_orden($c, $a, $b);
            }
            break;

        // A = C
        case ($a == $c):
            if ($a > $b) {
                echo "A y C son iguales y mayores que B.<br>";
                imprimir_orden($a, $c, $b);
            } else {
                echo "B es mayor; A y C son iguales.<br>";
                imprimir_orden($b, $a, $c);
            }
            break;

        // B = C
        case ($b == $c):
            if ($b > $a) {
                echo "B y C son iguales y mayores que A.<br>";
                imprimir_orden($b, $c, $a);
            } else {
                echo "A es mayor; B y C son iguales.<br>";
                imprimir_orden($a, $b, $c);
            }
            break;
    }
}
?>

<!-- Usamos un html para recoger los datos del usuario -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comparar 3 números</title>
</head>
<body>
    <h2>Comparación de 3 números</h2>
    <form method="post">
            <!-- Pedimos los 3 numeros -->
            <h2>Datos de entrada</h2>
            <div class="row">
                <label for="num1">Primer número (A):</label>
                <input type="number" id="num1" name="num1">
            </div>
            <div class="row">
                <label for="num2">Segundo número (B):</label>
                <input type="number" id="num2" name="num2">
            </div>
            <div class="row">
                <label for="num3">Tercer número (C):</label>
                <input type="number" id="num3" name="num3">
            </div>

            <!-- Pedimos que tipo de metodo queremos usar -->
            <div class="row">
                <strong>Método:</strong><br>
                <label><input type="radio" name="metodo" value="if"> IF</label>
                &nbsp;&nbsp;
                <label><input type="radio" name="metodo" value="switch"> SWITCH</label>
            </div>

            <!-- Bonton de confirmar para empezar a trabajar -->
            <button type="submit" name="comparar">Comparar</button>
    </form>

    <?php if (isset($_POST['comparar'])): ?>
        <div class="resultado">
            <?php
            // Asignamos los valores a cada variable y forzamos el tipo (Int) por seguridad
            $a = intval($_POST['num1']);
            $b = intval($_POST['num2']);
            $c = intval($_POST['num3']);
            $metodo = $_POST['metodo'] ?? 'if';

            if ($metodo === 'switch') {
                resolver_con_switch($a, $b, $c);
            } else {
                resolver_con_if($a, $b, $c);
            }
            ?>
        </div>
    <?php endif; ?>
</body>
</html>

