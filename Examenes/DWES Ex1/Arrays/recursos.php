<?php

$clientes = [
    [
        'id' => 1,
        'nombre' => 'Juan',
        'apellidos' => 'García López',
        'email' => 'juan.garcia@email.com',
        'telefono' => '612345678',
        'edad' => 32,
        'ciudad' => 'Madrid',
        'productos' => [
            'P001' => [
                'nombre' => 'Ratón inalámbrico',
                'precio' => 25.99,
                'descripcion' => 'Ratón ergonómico con conexión Bluetooth y batería recargable'
            ],
            'P002' => [
                'nombre' => 'Teclado mecánico',
                'precio' => 89.50,
                'descripcion' => 'Teclado gaming RGB con switches azules'
            ],
            'P003' => [
                'nombre' => 'Monitor 24"',
                'precio' => 179.99,
                'descripcion' => 'Monitor Full HD con panel IPS y 75Hz'
            ]
        ]
    ],
    [
        'id' => 2,
        'nombre' => 'María',
        'apellidos' => 'Martínez Ruiz',
        'email' => 'maria.martinez@email.com',
        'telefono' => '623456789',
        'edad' => 28,
        'ciudad' => 'Barcelona',
        'productos' => [
            'P004' => [
                'nombre' => 'Webcam HD',
                'precio' => 45.00,
                'descripcion' => 'Cámara web 1080p con micrófono integrado'
            ],
            'P005' => [
                'nombre' => 'Auriculares Bluetooth',
                'precio' => 65.99,
                'descripcion' => 'Auriculares inalámbricos con cancelación de ruido'
            ]
        ]
    ],
    [
        'id' => 3,
        'nombre' => 'Carlos',
        'apellidos' => 'Sánchez Pérez',
        'email' => 'carlos.sanchez@email.com',
        'telefono' => '634567890',
        'edad' => 45,
        'ciudad' => 'Valencia',
        'productos' => [
            'P001' => [
                'nombre' => 'Ratón inalámbrico',
                'precio' => 25.99,
                'descripcion' => 'Ratón ergonómico con conexión Bluetooth y batería recargable'
            ],
            'P006' => [
                'nombre' => 'Alfombrilla gaming',
                'precio' => 15.50,
                'descripcion' => 'Alfombrilla XXL con base antideslizante'
            ],
            'P007' => [
                'nombre' => 'Hub USB 3.0',
                'precio' => 22.99,
                'descripcion' => 'Concentrador USB con 7 puertos de alta velocidad'
            ],
            'P008' => [
                'nombre' => 'Cable HDMI 2m',
                'precio' => 8.99,
                'descripcion' => 'Cable HDMI 2.0 compatible con 4K'
            ]
        ]
    ],
    [
        'id' => 4,
        'nombre' => 'Laura',
        'apellidos' => 'Fernández Torres',
        'email' => 'laura.fernandez@email.com',
        'telefono' => '645678901',
        'edad' => 35,
        'ciudad' => 'Sevilla',
        'productos' => [
            'P002' => [
                'nombre' => 'Teclado mecánico',
                'precio' => 89.50,
                'descripcion' => 'Teclado gaming RGB con switches azules'
            ],
            'P009' => [
                'nombre' => 'SSD 1TB',
                'precio' => 95.00,
                'descripcion' => 'Disco sólido SATA III con velocidad de lectura 550MB/s'
            ]
        ]
    ],
    [
        'id' => 5,
        'nombre' => 'Pedro',
        'apellidos' => 'López Gómez',
        'email' => 'pedro.lopez@email.com',
        'telefono' => '656789012',
        'edad' => 52,
        'ciudad' => 'Bilbao',
        'productos' => [
            'P003' => [
                'nombre' => 'Monitor 24"',
                'precio' => 179.99,
                'descripcion' => 'Monitor Full HD con panel IPS y 75Hz'
            ],
            'P005' => [
                'nombre' => 'Auriculares Bluetooth',
                'precio' => 65.99,
                'descripcion' => 'Auriculares inalámbricos con cancelación de ruido'
            ],
            'P010' => [
                'nombre' => 'Soporte para portátil',
                'precio' => 28.50,
                'descripcion' => 'Soporte ajustable de aluminio para laptop'
            ]
        ]
    ]
];


// IMPLEMENTA AQUÍ TU CÓDIGO.

function obtenerArray(){

    global $clientes;

    return $clientes;
}

function obtenerListaProductos(array $clientes)
{
    $productos = [];

    foreach ($clientes as $cliente => $productos2) {
       $productos = array_merge($productos, $productos2["productos"]);
    }


    return $productos;

}

function obtenerClientesPorProductos(array $clientes, string $codigoProducto)
{
    $clientesPorObjeto = [];

    foreach ($clientes as $cliente) {
        
        $claveProductos = array_keys($cliente["productos"]);

        if (in_array($codigoProducto, $claveProductos)){

            $clientesPorObjeto [] = $cliente;
        }
    }

     return $clientesPorObjeto;
}

function obtenerProductosPorRangoPrecio(array $clientes, float $precioMin, float $precioMax)
{
    $productos = obtenerListaProductos($clientes);

    $productosRango = [];

    foreach ($productos as $codigo => $producto) {
        if($producto["precio"] <= $precioMax && $producto["precio"] >= $precioMin)

            $productosRango [$codigo] = $producto;
    }

    return $productosRango;
}

function contarProductosPorCliente(array $clientes)
{
    $clientesProductos = [];
    foreach ($clientes as $cliente) {
        $clientesProductos [] = ["nombre" => $cliente["nombre"],
                                "apellidos" => $cliente["apellidos"],
                                "numero" => count($cliente["productos"])];
    }

    return $clientesProductos;
}

?>