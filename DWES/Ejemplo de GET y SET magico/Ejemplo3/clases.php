<?php

/**
 * Clase Persona - Ejemplo 3: Métodos mágicos con lógica de transformación y validación
 * __get aplica transformaciones (formateo de DNI, capitalización de nombres)
 * __set aplica validaciones (rango de edad permitido)
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
     * Método mágico __get con transformaciones
     * - DNI: Oculta todos los dígitos excepto los últimos 4
     * - Nombre/Apellido: Capitaliza la primera letra
     */
    public function __get(string $propiedad): mixed
    {
        if (property_exists($this, $propiedad)) {
            if ($propiedad === 'dni') {
                // Oculta el DNI mostrando solo los últimos 4 dígitos
                return '****' . substr($this->$propiedad, -4);
            } elseif ($propiedad === 'nombre' || $propiedad === 'apellido') {
                // Formatea el nombre con la primera letra en mayúscula
                return ucfirst(strtolower($this->$propiedad));
            }
            return $this->$propiedad;
        }
        return null;
    }

    /**
     * Método mágico __set con validaciones
     * - Edad: Solo acepta valores entre 1 y 99
     */
    public function __set(string $propiedad, mixed $valor): void
    {
        if (property_exists($this, $propiedad)) {
            if ($propiedad === 'edad') {
                // Valida que la edad esté en un rango permitido
                if ($valor > 0 && $valor < 100) {
                    $this->$propiedad = $valor;
                }
            } else {
                $this->$propiedad = $valor;
            }
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
