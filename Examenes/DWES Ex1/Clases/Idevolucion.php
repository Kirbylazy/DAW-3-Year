<?php

interface devolucion
{
    public function devolverProducto($producto, string $motivo):void;
    public function obtenerDevoluciones():array;

}