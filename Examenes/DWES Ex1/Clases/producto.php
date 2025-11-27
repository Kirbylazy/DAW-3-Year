<?php

class Producto
{
    private int $id; //identificador unico
    protected string $nombre; //Nombre del
    protected float $precio; //identificador unico
    public int $stock; //identificador unico
    private int $garantia; //identificador unico
    static public $totalProductos; //identificador unico

    public function __construct($id, $nombre, $precio, $stock, $garantia)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->garantia = $garantia;
        self::$totalProductos++;
    }

    public function __destruct()
    {
        self::$totalProductos--;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getGarantia()
    {
        return $this->garantia;
    }
}