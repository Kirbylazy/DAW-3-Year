<?php

// Crea una clase Coche que herede de la clase Vehiculo 
// con los siguientes atributos privados:

// matricula
// kilometros
// El atributo kilómetros por defecto tendrá el valor de 0.

// Crea también los siguientes métodos:

// constructor con valor por defecto a cadena vacía para la matrícula. Si al constructor llega una matrícula se tiene que validar 
// la misma. métodos get y set para la matrícula. Al establecer la matrícula se tiene que validar la misma.
// método puedeCircular. Este método devuelve un booleano que nos indica si el coche puede circular. Para que un coche pueda circular 
// tiene que tener una matrícula válida.
// método viajar. Este método recibe los kilómetros que vamos a viajar y actualiza este atributo de nuestra clase siempre que podamos 
// circular y el coche se encuentre arrancado. No podemos viajar un número de kilómetros negativos.
// toString: con la información del coche.
// Para probar la clase utiliza el mismo fichero en el que has creado los vehículos. Crea varios coches y prueba los distintos métodos 
// de la clase.

// Validación de la matrícula: Una matrícula es válida si tiene el siguiente formato: 4 números, un espacio en blanco y 
// tres letras en mayúsculas. Dentro de las letras no pueden aparecer las siguientes: A, E, I, Ñ, O, Q, U.

/**
 * Clase Coche
 * 
 * Hereda de la clase Vehiculo e incluye atributos y métodos adicionales
 * específicos de un coche, como la matrícula y el kilometraje.
 */
require_once("vehiculo.php");

class coche extends vehiculo {

    /** @var string Matrícula del coche */
    private $matricula;

    /** @var int Kilómetros recorridos por el coche */
    private $kilometros = 0;

    /**
     * Constructor de la clase Coche
     * 
     * Inicializa el coche con una matrícula opcional.  
     * Usa el método setMatricula() para validar el formato de la matrícula.
     * 
     * @param string $m Matrícula del coche (opcional)
     */
    public function __construct(string $m = "") {
        $this->setMatricula($m);
    }

    /**
     * Obtiene la matrícula del coche.
     * 
     * @return string Matrícula actual del coche.
     */
    public function getMatricula() {
        return $this->matricula;
    }

    /**
     * Establece la matrícula del coche, comprobando su validez.
     * 
     * Si el formato no es válido, la matrícula se guarda como cadena vacía.
     * 
     * @param string $m Matrícula a establecer.
     * @return void
     */
    public function setMatricula(string $m = "") {
        if ($this->validarMatricula($m)) {
            $this->matricula = $m;
        } else {
            $this->matricula = "";
        }
    }

    /**
     * Valida una matrícula según el formato español actual:
     * 
     * - 4 números
     * - un espacio
     * - 3 letras mayúsculas sin vocales ni las letras Ñ, Q.
     * 
     * Ejemplo válido: `1234 BCD`
     * 
     * @param string $vm Matrícula a validar.
     * @return bool True si el formato es correcto, False en caso contrario.
     */
    public function validarMatricula(string $vm): bool {
        // Expresión regular para validar el formato
        // ^          → inicio de cadena
        // \d{4}      → cuatro dígitos
        // \s         → un espacio
        // [B-DF-HJ-NP-TV-Z]{3} → tres letras válidas (sin A, E, I, Ñ, O, Q, U)
        // $          → fin de cadena
        $patron = '/^[0-9]{4}\s[B-DF-HJ-NP-TV-Z]{3}$/';

        if (preg_match($patron, $vm)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Simula un viaje del coche sumando kilómetros recorridos.
     * 
     * Solo se suman kilómetros si:
     * - La matrícula no está vacía.
     * - El coche no está aparcado.
     * - La cantidad de kilómetros es positiva.
     * 
     * @param int $km Kilómetros a sumar.
     * @return void
     */
    public function viajar(int $km) {
        if ($this->matricula != "" && !$this->isAparcado()) {
            if ($km > 0) {
                $this->kilometros = $this->kilometros + $km;
            }
        }
    }

    /**
     * Convierte la información del coche en una cadena de texto legible.
     * 
     * Incluye los datos heredados de Vehiculo y añade información específica
     * del coche (matrícula y kilometraje).
     * 
     * @return string Descripción completa del coche.
     */
    public function __toString() {
        // Llamamos al __toString() de la clase padre (vehiculo)
        $mVehiculo = parent::__toString();

        // Añadimos la información adicional del coche
        $mCoche = " Es un coche con " . $this->matricula . " como matrícula " .
                  "y ha recorrido " . $this->kilometros . " kilómetros.";

        return $mVehiculo . $mCoche;
    }
}

?>