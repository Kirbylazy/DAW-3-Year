<?php

function obtenerArchivoCliente(string $id_cliente): string
{
    $archivo = $id_cliente . '.txt';

    // Inicializar el archivo si no existe
    if (!file_exists($archivo)) {
        file_put_contents($archivo, serialize([]));
    }

    return $archivo;
}

function leerPaquetes(string $id_cliente): array
{
    $archivo = obtenerArchivoCliente($id_cliente);

    $datos = file_get_contents($archivo);
    if ($datos === false || $datos === '') {
        return [];
    }

    $paquetes = @unserialize($datos);
    return is_array($paquetes) ? $paquetes : [];
}

function guardarPaquetes(string $id_cliente, array $paquetes): void
{
    $archivo = obtenerArchivoCliente($id_cliente);
    file_put_contents($archivo, serialize($paquetes));
}

function anadirPaquete(string $id_cliente, object $paquete): void
{
    $paquetes = leerPaquetes($id_cliente);
    $paquetes[] = $paquete;
    guardarPaquetes($id_cliente, $paquetes);
}

function calcularCosteTotal(array $paquetes): float
{
    $total = 0.0;

    foreach ($paquetes as $p) {
        $total += (float)$p->calcularCoste();
    }

    return $total;
}

// NO TOCAR
function generarIdPaquete(): string
{
    return uniqid('PKG_');
}

