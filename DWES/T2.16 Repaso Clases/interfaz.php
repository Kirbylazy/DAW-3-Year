<?php 
// Interfaz 
interface FirmaDigital {
    // Establece la variable firma a true
    public function firmar(string $usuario): string;
}
?>