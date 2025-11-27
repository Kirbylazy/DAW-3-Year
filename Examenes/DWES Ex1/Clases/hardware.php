<?php

require_once "producto.php";
require_once "Idevolucion.php";

class Hardware extends Producto implements devolucion
{
    public const ESTADO_INICIAL = "Nuevo";
    public const ESTADO_DEVUELTO = "Devuelto";
    public const GARANTIA_HW = 36;

    private string $fabricante;
    private string $estado;
    private array $variablesDinamicas;
    static private array $devolucionesHardware;
    static private int $totalHardware;

    public function __construct($id, $nombre, $precio, $stock, $f)
    {
        $this->fabricante = $f;
        return parent::__construct($id, $nombre, $precio, $stock, self::GARANTIA_HW);
        self::$totalHardware++;
    }

    public function __destruct()
    {
        return parent::__destruct();
        self::$totalHardware--;
    }

    public function devolverProducto($producto, string $motivo):void
    {
        $this->estado = self::ESTADO_DEVUELTO;
        $this->motivo = $motivo;
        self::$devolucionesHardware [] = $producto;
    }

    public function __set($name, $value)
    {
       if (!property_exists($this,$name))
       {
        $variablesDinamicas = [$name => $value];
       }
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->variablesDinamicas))
        {
            return $this->variablesDinamicas[$name];
        }
    }

    public function obtenerDevoluciones(): array
    {
        return self::$devolucionesHardware;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): void
    {
        $this->estado = $estado;
    }

    public function __toString()
    {
        $garantia = $this->getGarantia();
        $mensaje = $this->nombre . "Fabricante: " . $this->fabricante . 
                            "Grantia: " . $garantia .
                            "Stock: " . $this->stock .
                            "Precio: " . $this->precio .
                            "Estado: " . $this->estado;
        return $mensaje;
    }

}