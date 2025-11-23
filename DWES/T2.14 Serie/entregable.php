<?php
//      Como vemos, en principio, las clases anteriores no son padre-hija, pero si tienen cosas en
// común, por eso vamos a hacer una interfaz llamada Entregable con los siguientes
// métodos:

// Entregar(): cambia el atributo prestado a true.
// Devolver(): cambia el atributo prestado a false.
// isEntregado(): devuelve el estado del atributo prestado.
// Implementa los anteriores métodos en las clases Videojuego y Serie.
//      Crea un nuevo fichero (main.php) que importe las clases anteriores y realiza lo siguiente:

// Crea dos arrays, uno de Series y otro de Videojuegos, de 5 posiciones cada uno.
// Crea un objeto en cada posición del array, con los valores que desees
// Entrega algunos Videojuegos y Series con el método entregar().
// Cuenta cuantos Series y Videojuegos hay entregados. Al contarlos, devuélvelos (utiliza el método devolver).
// Indica el videojuego tiene más horas estimadas y la serie con más temporadas.
// Muestra los datos en pantalla con toda su información (usa el método toString()).

interface entregable
{
    public function Entregar();
    public function Devolver();
    public function isEntregado();
}

?>