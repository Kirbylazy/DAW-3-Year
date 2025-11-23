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
        return parent::__construct($a, $l, $dc);
        parent::$dobleCara = true;
        $this->$paginas = $p;
        $this->$alto = $p / 100;
        parent::$paginasGastadas = parent::$paginasGastadas + $p;
    }

    public function __destruct()
    {
        parent::$paginasRecicladas = parent::$paginasRecicladas - $this->paginas;
    }

    public function __toString()
    {
        return "Libro de " . $this->paginas . " paginas, titulado " . $this->titulo;
    }

    public function calcularEspacio()
    {
        return parent::$ancho * parent::$largo * $this->alto;
    }


    public function embalar(int $n)
    {
        return (($this->ancho*$n) + (iEmbalaje::MARGEN * 2) + (iEmbalaje::volumenEnvoltorio * 2)) * 
        (($this->largo*$n) + (iEmbalaje::MARGEN * 2) + (iEmbalaje::volumenEnvoltorio * 2)) * 
        (($this->alto*$n) +(iEmbalaje::MARGEN * 2) + (iEmbalaje::volumenEnvoltorio * 2));
    }
}


?>