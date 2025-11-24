<?php
class cliente
{
    private $nombre;
    private $producto;
    public $apodo;
    static private $clientela;

    public function __construct(string $n)
    {
        $this->nombre = $n;
        $this->producto = "";
        self::$clientela++;
        echo $this->nombre . " creado";
        echo "<br>";
    }

    public function __destruct()
    {
        self::$clientela = self::$clientela--;
    }

    public function comprar($p)
    {
        if ($this->producto == "")
        {
            $this->producto = [$p];
        }else 
        {
            $this->producto[] = $p;
        }
    }

    public function getProducto()
    {
        return $this->producto;
    }

    static public function getClientela()
    {
        return self::$clientela;
    }

    public function __tostring()
    {
        return "Su nombre es " . $this->nombre;
    }
}

?>