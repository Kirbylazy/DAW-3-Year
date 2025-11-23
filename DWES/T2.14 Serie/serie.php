<?php
// Crea una clase Serie con las siguientes características:

//      Sus atributos privados son:

// Título
// Número de temporadas
// prestado
// Género
//      Crear el constructor de la clase, sabiendo que al principio el atributo prestado siempre vale
// False.

//      Los métodos que se tienen que implementar son:

// Métodos get de todos los atributos, excepto de prestado.
// Métodos set de todos los atributos, excepto de prestado.
// Método toString para devolver la información de la serie.

// Incluye el archivo "entregable.php", que probablemente contiene
// una interfaz o clase base con métodos como entregar(), devolver(), etc.
include_once("entregable.php");

// Definición de la clase "serie"
class serie
{
    // Propiedades privadas → solo accesibles desde dentro de la clase
    private $titulo;        // Título de la serie
    private $nTemporadas;   // Número de temporadas que tiene la serie
    private $prestado;      // Indica si la serie está prestada o no
    private $genero;        // Género de la serie (drama, comedia, acción, etc.)

    // Propiedad estática → compartida por todas las instancias
    public static $temporadas;  // Guarda la serie con mayor número de temporadas

    // Constructor → se ejecuta automáticamente al crear un nuevo objeto de tipo serie
    public function __construct(string $t, int $nt, string $g)
    {
        // Inicializa los atributos con los valores recibidos
        $this->titulo = $t;
        $this->nTemporadas = $nt;
        $this->prestado = false; // Por defecto, la serie recién creada no está prestada
        $this->genero = $g;

        // --- Lógica de la propiedad estática ---
        // Si aún no hay una serie registrada como "la de más temporadas"
        if (empty(self::$temporadas)) {
            self::$temporadas = $this; // Guardamos la actual como referencia
        } else {
            // Si la nueva serie tiene más temporadas que la actual "máxima", la sustituye
            if ($this->nTemporadas > self::$temporadas->nTemporadas) {
                self::$temporadas = $this;
            }
        }
    }

    // --- Getters y Setters (accesores y modificadores) ---

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo(string $t)
    {
        $this->titulo = $t;
    }

    public function getNTemporadas()
    {
        return $this->nTemporadas;
    }

    public function setNTemporadas(int $nt)
    {
        $this->nTemporadas = $nt;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function setGenero(string $g)
    {
        $this->genero = $g;
    }

    // --- Método mágico __toString() ---
    // Permite representar el objeto como texto (por ejemplo, con echo $objeto)
    public function __toString()
    {
        // Comprueba si la serie está prestada y define el texto adecuado
        if ($this->isPrestado()) {
            $p = "prestada.";
        } else {
            $p = "disponible.";
        }

        // Construye el mensaje con los datos de la serie
        $mensaje = "La serie " . $this->titulo .
                   " tiene " . $this->nTemporadas .
                   " temporadas y es del género " . $this->genero .
                   " y está <strong>" . $p . "</strong>";

        // Devuelve la cadena formateada
        return $mensaje;
    }

    // --- Métodos para cambiar el estado de préstamo ---

    public function Entregar()
    {
        $this->prestado = true; // Marca la serie como prestada
    }

    public function Devolver()
    {
        $this->prestado = false; // Marca la serie como devuelta
    }

    public function isPrestado()
    {
        return $this->prestado; // Devuelve true si la serie está prestada
    }
}
?>
