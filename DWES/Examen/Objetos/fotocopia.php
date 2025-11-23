<?php
require_once ("papel.php");

class fotocopia extends papel
{
    private $color;

    public function __construct(int $a, int $l, bool $dc = false)
    {
        parent::$paginasGastadas++;
        return parent::__construct($a, $l, $dc);

    }

    public function __destruct()
    {
        parent::$paginasRecicladas++;
    }

    public function __toString()
    {
        return parent::__toString() . "Tiene doble cara: " . parent::getDobleCara();
    }

    public function calcularEspacio()
    {
        return $this->ancho * $this->largo;
    }

    public function getPaginasGastadas()
    {
        return parent::$paginasGastadas;
    }

    public function getPaginasRecicladas()
    {
        return parent::$paginasRecicladas;
    }
}

?>