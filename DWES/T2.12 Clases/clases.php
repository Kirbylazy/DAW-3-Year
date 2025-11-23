<?php

// Crea una clase Persona con los siguientes atributos privados:

// nombre
// apellidos
// edad
// Crea también los siguientes métodos:
// constructor con valores por defecto, nombre y apellidos vacíos y edad igual a 18.
// get y set para cada uno de los atributos.
// mayorEdad: Devuelve un booleano indicando si es o no mayor de edad.
// nombreCompleto: devuelve una cadena con el nombre más los apellidos de la persona
// Para probar la clase crea un fichero nuevo que incluya a la clase Persona. A continuación
// crea una Persona con sus datos, nombre, apellidos y edad, y prueba los distintos métodos.

class persona {
    const MAYORIA_EDAD = 18;
    private $nombre;
    private $apellidos;
    private $edad;

    public function __construct (string $n = "",string $a = "", int $e = 18){

        $this->nombre = $n;
        $this->apellidos = $a;
        $this->edad = $e;
    }

    public function setNombre ($n){

    $this->nombre = $n;
    }

    public function getNombre (){

    return $this->nombre;
    }

    public function setApellidos ($a){

    $this->apellidos = $a;
    }

    public function getApellidos (){

    return $this->apellidos;
    }

    public function setEdad ($e){

    $this->edad = $e;
    }

    public function getEdad (){

    return $this->edad;
    }

    public function mayorEdad(): bool{

        return $this->edad >= self::MAYORIA_EDAD;
    }

    public function presentar(): string{

        return $this->nombre . " " . $this->apellidos;
    }

    public function __tostring(): string{
        
        return $this->nombre . " " . $this->apellidos. " " . $this->edad. " años";
    }

}

?>