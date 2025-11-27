<?php

require_once "producto.php";

class Software extends Producto
{
    public const GARANTIA_SW = 1;

    private string $licenciaTipo;
    static public int $totalSoftware;

    public function __construct($id, $nombre, $precio, $stock, $licencia)
    {
        return parent::__construct($id, $nombre, $precio, $stock, self::GARANTIA_SW);
        $this->licenciaTipo = $licencia;
        self::$totalSoftware++;
    }

    public function __destruct()
    {
        return parent::__destruct();
        self::$totalSoftware--;
    }

    public function __toString()
    {
        $garantia = $this->getGarantia();
        $mensaje = $this->nombre . "Licencia: " . $this->licenciaTipo . 
                            "Grantia: " . $garantia .
                            "Stock: " . $this->stock .
                            "Precio: " . $this->precio;
        return $mensaje;
    }
}