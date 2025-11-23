<?php
//      Crea una clase Videojuego con las siguientes características:
//      Sus atributos privados son:

// Título
// Horas estimadas
// prestado
// Género
//      Crear el constructor de la clase, sabiendo que al principio prestado siempre vale false.
//      Los métodos que se implementara serán:

// Métodos get de todos los atributos, excepto de prestado.
// Métodos set de todos los atributos, excepto de prestado.
// Método toString para devolver la información del juego.
//      Como vemos, en principio, las clases anteriores no son padre-hija, pero si tienen cosas en
// común, por eso vamos a hacer una interfaz llamada Entregable con los siguientes
// métodos:

// Entregar(): cambia el atributo prestado a true.
// Devolver(): cambia el atributo prestado a false.
// isprestado(): devuelve el estado del atributo prestado.
// Implementa los anteriores métodos en las clases Videojuego y Serie.
//      Crea un nuevo fichero (main.php) que importe las clases anteriores y realiza lo siguiente:

// Crea dos arrays, uno de Series y otro de Videojuegos, de 5 posiciones cada uno.
// Crea un objeto en cada posición del array, con los valores que desees
// Entrega algunos Videojuegos y Series con el método entregar().
// Cuenta cuantos Series y Videojuegos hay prestados. Al contarlos, devuélvelos (utiliza el método devolver).
// Indica el videojuego tiene más horas estimadas y la serie con más temporadas.
// Muestra los datos en pantalla con toda su información (usa el método toString()).

// Incluimos un archivo externo (probablemente define una interfaz o clase base "entregable")
include_once("entregable.php");

// Definición de la clase "videojuego"
class videojuego
{
    // Atributos privados (solo accesibles dentro de la clase)
    private $titulo;        // Título del videojuego
    private $hEstimadas;    // Horas estimadas de duración
    private $prestado;      // Estado: si está prestado o no
    private $genero;        // Género del videojuego (aventura, acción, etc.)

    // Atributo estático
    public static $horas;   // Guarda el videojuego con mayor número de horas estimadas

    // Constructor: se ejecuta al crear un nuevo objeto de esta clase
    public function __construct(string $t, int $he, string $g)
    {
        // Inicializa las propiedades del objeto con los valores recibidos
        $this->titulo = $t;
        $this->hEstimadas = $he;
        $this->prestado = false; // Por defecto, un juego recién creado no está prestado
        $this->genero = $g;

        // --- Gestión de la propiedad estática ---
        // Si aún no hay ningún juego guardado en self::$horas...
        if (empty(self::$horas)) {
            self::$horas = $this; // ...guardamos este como el primero (referencia al propio objeto)
        } else {
            // Si el nuevo juego tiene más horas que el que estaba guardado, lo sustituye
            if ($this->hEstimadas > self::$horas->hEstimadas) {
                self::$horas = $this;
            }
        }
    }

    // --- Métodos Getter y Setter ---

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo(string $t)
    {
        $this->titulo = $t;
    }

    public function getHEstimadas()
    {
        return $this->hEstimadas;
    }

    public function setHEstimadas(int $he)
    {
        $this->hEstimadas = $he;
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
    // Permite mostrar el objeto como texto (por ejemplo, con echo $objeto)
    public function __toString()
    {
        // Comprobamos si el juego está prestado
        if ($this->isPrestado()) {
            $p = "prestado.";
        } else {
            $p = "disponible.";
        }

        // Construimos el mensaje de texto a mostrar
        $mensaje = "El juego " . $this->titulo .
                   " tiene " . $this->hEstimadas .
                   " horas estimadas y es del género " . $this->genero .
                   " y está <strong>" . $p . "</strong>";

        // Devolvemos el mensaje (como string)
        return $mensaje;
    }

    // --- Métodos de préstamo ---
    public function Entregar()
    {
        $this->prestado = true; // Marca el juego como prestado
    }

    public function Devolver()
    {
        $this->prestado = false; // Marca el juego como devuelto
    }

    public function isPrestado()
    {
        return $this->prestado; // Devuelve true si el juego está prestado
    }
}



?>