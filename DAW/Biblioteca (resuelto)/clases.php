<?php

// Clase base para materiales bibliográficos
class Material {
    public $identificador; // ISBN u otro identificador único
    public $titulo;
    public $disponible;

    public function __construct($identificador, $titulo, $disponible = true) {
        $this->identificador = $identificador;
        $this->titulo = $titulo;
        $this->disponible = $disponible;
    }

    public function mostrarInfo() {
        return "Identificador: {$this->identificador} | Título: {$this->titulo} | Estado: " . 
               ($this->disponible ? "Disponible" : "No disponible");
    }
}

// Clase para libros que hereda de Material
class Libro extends Material {
    public $autor;

    public function __construct($isbn, $titulo, $autor, $disponible = true) {
        parent::__construct($isbn, $titulo, $disponible);
        $this->autor = $autor;
    }

    public function mostrarInfo() {
        return "LIBRO | " . parent::mostrarInfo() . " | Autor: {$this->autor}";
    }
}

// Clase para revistas que hereda de Material
class Revista extends Material {
    public $numero;

    public function __construct($issn, $titulo, $numero, $disponible = true) {
        parent::__construct($issn, $titulo, $disponible);
        $this->numero = $numero;
    }

    public function mostrarInfo() {
        return "REVISTA | " . parent::mostrarInfo() . " | Número: {$this->numero}";
    }
}

?>