<?php

// Crea una clase Vehiculo con los siguientes atributos privados:

// marca
// color
// plazas
// aparcado
// El atributo aparcado por defecto tendrá el valor True.

// Crea también los siguientes métodos:
// constructor con valor por defecto a cero para las plazas. Las plazas tienen que ser un número entero positivo.
// get y set para los atributos marca, color y plazas. A la hora de establecer las plazas se tiene que controlar que es un número 
// positivo. aparcar: que establece el aparcado a True.
// arrancar: que establece el aparcado a False.
// IsAparcado: que devuelve True si el coche está aparcado y False en caso contrario.
// toString: con la información del vehículo.
// Para probar la clase crea un fichero nuevo que incluya a la clase Vehiculo y que el mismo varios vehículos como una bicicleta, 
// un camión, un patinete eléctrico o una moto y prueba  los distintos métodos. Crea una clase Coche que herede de la clase Vehiculo 
// con los siguientes atributos privados:

// matricula
// kilometros
// El atributo kilómetros por defecto tendrá el valor de 0.

// Crea también los siguientes métodos:

// constructor con valor por defecto a cadena vacía para la matrícula. Si al constructor llega una matrícula se tiene que validar la misma.
// métodos get y set para la matrícula. Al establecer la matrícula se tiene que validar la misma.
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
 * Clase Vehiculo
 * 
 * Representa un vehículo genérico con atributos básicos como marca, color, número de plazas
 * y estado (aparcado o arrancado).
 */
class vehiculo {

    /** @var string Marca del vehículo */
    private $marca;

    /** @var string Color del vehículo */
    private $color;

    /** @var int Número de plazas del vehículo */
    private $plazas;

    /** @var bool Indica si el vehículo está aparcado (true) o arrancado (false) */
    private $aparcado = true;

    /**
     * Constructor de la clase Vehiculo
     * 
     * @param string $m Marca del vehículo (opcional)
     * @param string $c Color del vehículo (opcional)
     */
    public function __construct(string $m = "", string $c = "") {
        $this->marca = $m;
        $this->color = $c;
        $this->plazas = 0;
        $this->aparcado = true; // Por defecto, el vehículo se inicia aparcado
    }

    /**
     * Obtiene la marca del vehículo
     * 
     * @return string Marca actual del vehículo
     */
    public function getMarca() {
        return $this->marca;
    }

    /**
     * Establece la marca del vehículo
     * 
     * @param string $m Nueva marca del vehículo
     * @return void
     */
    public function setMarca(string $m = "") {
        $this->marca = $m;
    }

    /**
     * Obtiene el color del vehículo
     * 
     * @return string Color actual del vehículo
     */
    public function getColor() {
        return $this->color;
    }

    /**
     * Establece el color del vehículo
     * 
     * @param string $c Nuevo color del vehículo
     * @return void
     */
    public function setColor(string $c = "") {
        $this->color = $c;
    }

    /**
     * Obtiene el número de plazas del vehículo
     * 
     * @return int Número de plazas
     */
    public function getPlazas() {
        return $this->plazas;
    }

    /**
     * Establece el número de plazas del vehículo.
     * 
     * Si el valor es menor o igual a cero, se establece en 0 por defecto.
     * 
     * @param int $p Número de plazas a asignar
     * @return void
     */
    public function setPlazas(int $p = 0) {
        if ($p > 0) {
            $this->plazas = $p;
        } else {
            $this->plazas = 0;
        }
    }

    /**
     * Cambia el estado del vehículo a "arrancado".
     * 
     * @return void
     */
    public function arrancar() {
        $this->aparcado = false;
    }

    /**
     * Comprueba si el vehículo está aparcado.
     * 
     * @return bool Devuelve true si está aparcado, false si está arrancado.
     */
    public function isAparcado() {
        if ($this->aparcado) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Convierte la información del vehículo en una cadena de texto legible.
     * 
     * Este método se ejecuta automáticamente cuando el objeto se imprime o se concatena en un string.
     * 
     * @return string Descripción detallada del vehículo.
     */
    public function __toString() {
        // Determinar el estado del vehículo
        if ($this->isAparcado()) {
            $ap = ". El vehículo está aparcado.";
        } else {
            $ap = ". El vehículo está arrancado.";
        }

        // Construir el mensaje completo
        $mensaje = "El vehículo es de la marca " . $this->marca .
                   ", de color " . $this->color .
                   ". Con " . $this->plazas . " plazas" .
                   $ap;

        return $mensaje;
    }
}

?>