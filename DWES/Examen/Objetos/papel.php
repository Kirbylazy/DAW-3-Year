<?php

abstract class papel
{
    static public $paginasGastadas = 0;
    static public $paginasRecicladas = 0;
    private $dobleCara;
    protected $ancho;
    protected $largo;

    public function __construct(int $a, int $l, bool $dc)
    {
        $this->ancho = $a;
        $this->largo = $l;
        $this->dobleCara = $dc;
    }

    abstract function calcularEspacio();

    public function getDobleCara()
    {
        return $this->dobleCara;
    }

    public function __toString()
    {
        return "Se usa un papel de tamaño: " . $this->ancho . " de alto y " 
        . $this->largo . " de largo.";
    }
}

?>