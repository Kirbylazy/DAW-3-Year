<?php
// Clase base para movimientos
class Movimiento {

    public string $fecha;
    public string $concepto;
    public int $cantidad;

    public function __construct(string $f, string $con, int $can)
    {
        $this->fecha = $f; 
        $this->concepto = $con;
        $this->cantidad = $can;

    }

    public function mostrarInfo(){


    }
}

// Clase para gastos
class Gasto extends Movimiento{

    public string $origen;

    public function __construct(string $f, string $con, int $can, string $o)
    {
        $this->origen = $o;
        parent::__construct($f, $con, $can);
    }

}

// Clase para ingresos
class Ingreso extends Movimiento {

    public string $destinatario;

    public function __construct(string $f, string $con, int $can, string $d)
    {
        $this->destinatario = $d;
        parent::__construct($f, $con, $can);
    }

}
?>