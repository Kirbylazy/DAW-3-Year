<?php

/**
 * Clase Persona - Ejemplo 2: Getters/Setters tradicionales + Propiedades dinámicas
 * Combina métodos tradicionales con __get/__set para propiedades dinámicas
 */
class Persona
{
    // Propiedades fijas de la clase
    private $nombre;
    private $apellido;
    private $edad;
    private $dni;

    // Array para almacenar propiedades dinámicas
    private $camposDinamicos = [];

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
     * Permite leer propiedades dinámicas que no están definidas en la clase
     */
    public function __get(string $propiedad): mixed
    {
        if (isset($this->camposDinamicos[$propiedad])) {
            return $this->camposDinamicos[$propiedad];
        }

        return null;
    }

    /**
     * Método mágico __set
     * Almacena propiedades dinámicas en el array cuando no existen en la clase
     */
    public function __set(string $propiedad, mixed $valor): void
    {
        if (!property_exists($this, $propiedad)) {
            // Solo guarda si la propiedad NO existe en la clase
            $this->camposDinamicos[$propiedad] = $valor;
        }
    }

    // Getters y setters tradicionales para las propiedades de la clase

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getApellido(): string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): void
    {
        $this->apellido = $apellido;
    }

    public function getEdad(): int
    {
        return $this->edad;
    }

    public function setEdad(int $edad): void
    {
        $this->edad = $edad;
    }

    public function getDni(): string
    {
        return $this->dni;
    }

    public function setDni(string $dni): void
    {
        $this->dni = $dni;
    }

    /**
     * Retorna el array de campos dinámicos
     */
    public function getCamposDinamicos(): array
    {
        return $this->camposDinamicos;
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
     * Convierte el objeto a string mostrando propiedades fijas y dinámicas
     */
    public function __toString(): string
    {
        $resultado = "Nombre: " . $this->getNombreCompleto() . "\n" .
                     "Edad: " . $this->edad . " años\n" .
                     "DNI: " . $this->dni;

        // Muestra los campos dinámicos si existen
        if (!empty($this->camposDinamicos)) {
            $resultado .= "\n\nCampos Dinámicos:";
            foreach ($this->camposDinamicos as $campo => $valor) {
                // ucfirst - Capitaliza la primera letra del campo
                $resultado .= "\n  - " . ucfirst($campo) . ": " . $valor;
            }
        }

        return $resultado;
    }
}
