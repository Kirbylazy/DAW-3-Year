<?php
class Alumno {
    private $nombre;
    private $tipo;
    private $notas = [];

    public function __construct($nombre) {
        $this->nombre = $nombre;
        $this->tipo = "alumno";
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function asignarNota($asignatura, $nota) {
        $this->notas[$asignatura] = $nota;
    }

    public function getNotas() {
        return $this->notas;
    }
}

class Profesor {
    private $nombre;
    private $tipo;

    public function __construct($nombre) {
        $this->nombre = $nombre;
        $this->tipo = "profesor";
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function asignarNota(Alumno $alumno, $asignatura, $nota) {
        $alumno->asignarNota($asignatura, $nota);
    }
}
?>