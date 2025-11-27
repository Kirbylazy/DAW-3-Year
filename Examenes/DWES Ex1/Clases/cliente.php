<?php

class Cliente {

    // Atributos
    private string $nombre;
    private string $email;
    private array $comprados;
    private array $variablesDinamicas;
    static public int $totalClientes;

    // Constructor
    public function __construct($n,$em)
    {
        $this->nombre = $n;
        $this->email = $em;
        $this->comprados = [];
        self::$totalClientes++;
    }

    public function agregarProducto(Producto $producto): void
    {
       if ($producto::$stock > 0)
       {
        $this->comprados[] = $producto;
        $producto::$stock--;
       }
    }

    public function getComprado(): array
    {
        return $this->comprados;
    }

    public function getNombre():string
    {
        return $this->nombre;
    }

    public function getEmail():string
    {
        return $this->email;
    }

    public function __toString()
    {
        $cantidad = count($this->comprados);
        $mensaje = "Cliente: " . $this->nombre . $this->email . 
                            "Productos Comprados: " . $cantidad;
        return $mensaje;
    }

}