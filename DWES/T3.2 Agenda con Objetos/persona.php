<?php

final class persona
{
   private $nombre;
   private $numero;
   
   public function __construct($no,$nu)
   {
    $this->nombre = $no;
    $this->numero = $nu;
   }

   public function getNombre()
   {
    return $this->nombre;
   }

   public function getNumero()
   {
    return $this->numero;
   }

   public function __toString()
   {
    return $this->nombre . ' ' . $this->numero;
   }
}


?>