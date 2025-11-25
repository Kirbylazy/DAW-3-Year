<?php

/**
 * Clase Persona - Ejemplo 1: Uso básico de métodos mágicos __get y __set
 * Permite acceder y modificar propiedades privadas desde fuera de la clase
 */
class Persona
{
    // Propiedades privadas de la clase
    private $nombre;
    private $apellido;
    private $edad;
    private $dni;

    /**
     * Constructor de la clase
     */
    public function __construct(string $nombre, string $apellido, int $edad, string $dni)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->edad = $edad;
        $this->dni = $dni;
    }

    /**
     * Método mágico __get
     * Se invoca automáticamente al intentar leer una propiedad inaccesible
     */
    public function __get(string $propiedad): mixed
    {
        if (property_exists($this, $propiedad)) {
            return $this->$propiedad;
        }
        return null;
    }

    /**
     * Método mágico __set
     * Se invoca automáticamente al intentar escribir en una propiedad inaccesible
     */
    public function __set(string $propiedad, mixed $valor): void
    {
        if (property_exists($this, $propiedad)) {
            $this->$propiedad = $valor;
        }
    }

    /**
     * Retorna el nombre completo de la persona
     */
    public function getNombreCompleto(): string
    {
        return $this->nombre . " " . $this->apellido;
    }

    /**
     * Método mágico __toString
     * Se invoca automáticamente al convertir el objeto a string
     */
    public function __toString(): string
    {
        return "Nombre: " . $this->getNombreCompleto() . "\n" .
               "Edad: " . $this->edad . " años\n" .
               "DNI: " . $this->dni;
    }
}
