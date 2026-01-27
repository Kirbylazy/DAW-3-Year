<?php
// Clase base para paquetes

class Paquete
{
    public $id;
    public $peso;
    public $destino;
    public $fecha_envio;
    
    public function __construct($id, $peso, $des, $fecha)
    {
        $this->id = $id;
        $this->peso = $peso;
        $this->destino = $des;
        $this->fecha_envio = $fecha;

    }

    // Cálculo básico: 5€ por kg

    public function calcularCoste()
    {
        $precio = $this->peso * 5;

        return $precio;
    }

    public function mostrarInfo()
    {
        $mensaje = 'Paquete normal sin detalles';

        return $mensaje;
    }
}

// Clase para paquetes urgentes

class PaqueteUrgente extends Paquete
{
        public $tiempo_garantizado;

        public function __construct($id, $peso, $des, $fecha, $tiempo)
        {
                $this->tiempo_garantizado = $tiempo;
                parent::__construct($id, $peso, $des, $fecha);
        }

        // Coste base + 10€ por cada hora de garantía

        public function calcularCoste()
        {
                $precio = (parent::calcularCoste()) + ($this->tiempo_garantizado * 10);

                return $precio;
        }

        public function mostrarInfo()
        {
                $mensaje = 'Paquete urgente con entrega garantizada en 24horas';

                return $mensaje;
        }
}

// Clase para paquetes frágiles

class PaqueteFragil extends Paquete
{
    public $instrucciones_especiales;

        public function __construct($id, $peso, $des, $fecha, $inst)
        {
                $this->instrucciones_especiales = $inst;
                parent::__construct($id, $peso, $des, $fecha);
        }

        // Coste base + 50% extra por manipulación especial

        public function calcularCoste()
        {
                $precio = (parent::calcularCoste()) * 1.5;

                return $precio;
        }

        public function mostrarInfo()
        {
                $mensaje = 'Paquete Fragil con entrega garantizada sin roturas';

                return $mensaje;
        }    
}

?>