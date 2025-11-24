<?php
require_once ("papel.php");
require_once("iEmbalaje.php");

class libro extends papel implements iEmbalaje
{
    public $titulo;
    private $paginas;
    private $alto;
    
    public function __construct(int $a, int $l, bool $dc, int $p)
    {
        parent::__construct($a, $l, $dc);
        self::$paginasGastadas = self::$paginasGastadas + $p;
    }

    public function __destruct()
    {
        self::$paginasRecicladas = self::$paginasRecicladas + $this->paginas;
    }

    public function __toString()
    {
        return "Libro de " . $this->paginas . " paginas, titulado " . $this->titulo;
    }

    public function calcularEspacio()
    {
        return $this->ancho * $this->largo * $this->alto;
    }


    public function embalar(int $n)
    {
        return (($this->ancho*$n) + (iEmbalaje::MARGEN * 2) + (iEmbalaje::volumenEnvoltorio * 2)) * 
        (($this->largo*$n) + (iEmbalaje::MARGEN * 2) + (iEmbalaje::volumenEnvoltorio * 2)) * 
        (($this->alto*$n) +(iEmbalaje::MARGEN * 2) + (iEmbalaje::volumenEnvoltorio * 2));
    }
}


?>