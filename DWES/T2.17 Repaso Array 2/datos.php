<?php
// Establecer codificación UTF-8
header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding('UTF-8');

/**
 * ARRAYS DE DATOS PARA EJERCICIOS
 * Profundidad máxima: 3 niveles
 */

// ============================================
// PRODUCTOS (3 niveles: categoria -> id -> datos)
// ============================================
$productos = [
    'portatiles' => [
        'P001' => [
            'nombre' => 'HP Pavilion 15',
            'precio' => 649.00,
            'stock' => 15,
            'valoracion' => 4.5
        ],
        'P002' => [
            'nombre' => 'Lenovo ThinkPad',
            'precio' => 1299.00,
            'stock' => 8,
            'valoracion' => 4.7
        ],
        'P003' => [
            'nombre' => 'Dell Inspiron',
            'precio' => 799.00,
            'stock' => 12,
            'valoracion' => 4.3
        ]
    ],
    'monitores' => [
        'M001' => [
            'nombre' => 'Samsung 27"',
            'precio' => 299.00,
            'stock' => 20,
            'valoracion' => 4.6
        ],
        'M002' => [
            'nombre' => 'LG UltraWide',
            'precio' => 449.00,
            'stock' => 10,
            'valoracion' => 4.8
        ]
    ],
    'teclados' => [
        'T001' => [
            'nombre' => 'Logitech K380',
            'precio' => 39.00,
            'stock' => 50,
            'valoracion' => 4.4
        ],
        'T002' => [
            'nombre' => 'Corsair K70',
            'precio' => 129.00,
            'stock' => 15,
            'valoracion' => 4.9
        ]
    ]
];

// ============================================
// CLIENTES (3 niveles: id -> sección -> datos)
// ============================================
$clientes = [
    'C001' => [
        'datos' => [
            'nombre' => 'Ana García',
            'email' => 'ana@email.com',
            'ciudad' => 'Madrid'
        ],
        'idiomas' => [
            'español' => 'nativo',
            'inglés' => 'B2',
            'francés' => 'A2'
        ],
        'compras' => ['P001', 'M001', 'T001']
    ],
    'C002' => [
        'datos' => [
            'nombre' => 'Carlos López',
            'email' => 'carlos@email.com',
            'ciudad' => 'Barcelona'
        ],
        'idiomas' => [
            'español' => 'nativo',
            'catalán' => 'nativo',
            'inglés' => 'C1'
        ],
        'compras' => ['P002', 'M002']
    ],
    'C003' => [
        'datos' => [
            'nombre' => 'María Rodríguez',
            'email' => 'maria@email.com',
            'ciudad' => 'Valencia'
        ],
        'idiomas' => [
            'español' => 'nativo',
            'valenciano' => 'nativo',
            'inglés' => 'B1',
            'alemán' => 'A2'
        ],
        'compras' => ['P003', 'T002']
    ],
    'C004' => [
        'datos' => [
            'nombre' => 'Pedro Martínez',
            'email' => 'pedro@email.com',
            'ciudad' => 'Sevilla'
        ],
        'idiomas' => [
            'español' => 'nativo',
            'inglés' => 'B2'
        ],
        'compras' => ['M001', 'T001']
    ],
    'C005' => [
        'datos' => [
            'nombre' => 'Laura Sánchez',
            'email' => 'laura@email.com',
            'ciudad' => 'Bilbao'
        ],
        'idiomas' => [
            'español' => 'nativo',
            'euskera' => 'C1',
            'inglés' => 'C2',
            'francés' => 'B2'
        ],
        'compras' => ['P001', 'P002', 'M001', 'M002', 'T001', 'T002']
    ]
];

// ============================================
// PROVEEDORES (3 niveles: id -> sección -> datos)
// ============================================
$proveedores = [
    'PR001' => [
        'datos' => [
            'nombre' => 'TecnoSupply España',
            'ciudad' => 'Madrid',
            'tipo' => 'nacional'
        ],
        'condiciones' => [
            'plazo_dias' => 3,
            'descuento' => 5,
            'metodo_pago' => '30 días'
        ],
        'productos' => ['P001', 'P002', 'M001']
    ],
    'PR002' => [
        'datos' => [
            'nombre' => 'Electrónica Barcelona',
            'ciudad' => 'Barcelona',
            'tipo' => 'nacional'
        ],
        'condiciones' => [
            'plazo_dias' => 5,
            'descuento' => 8,
            'metodo_pago' => '60 días'
        ],
        'productos' => ['M001', 'M002', 'T001']
    ],
    'PR003' => [
        'datos' => [
            'nombre' => 'Global Tech GmbH',
            'ciudad' => 'Berlín',
            'tipo' => 'internacional'
        ],
        'condiciones' => [
            'plazo_dias' => 15,
            'descuento' => 12,
            'metodo_pago' => 'prepago'
        ],
        'productos' => ['P001', 'P002', 'P003']
    ],
    'PR004' => [
        'datos' => [
            'nombre' => 'Asian Electronics',
            'ciudad' => 'Shanghai',
            'tipo' => 'internacional'
        ],
        'condiciones' => [
            'plazo_dias' => 30,
            'descuento' => 20,
            'metodo_pago' => 'prepago'
        ],
        'productos' => ['T001', 'T002', 'M001', 'M002']
    ]
];

// ============================================
// EMPLEADOS (3 niveles: departamento -> id -> datos)
// ============================================
$empleados = [
    'ventas' => [
        'E001' => [
            'nombre' => 'Juan Pérez',
            'salario' => 28000,
            'años_experiencia' => 5
        ],
        'E002' => [
            'nombre' => 'Sandra Ruiz',
            'salario' => 32000,
            'años_experiencia' => 8
        ],
        'E003' => [
            'nombre' => 'Miguel Torres',
            'salario' => 25000,
            'años_experiencia' => 2
        ]
    ],
    'soporte' => [
        'E004' => [
            'nombre' => 'Carmen Díaz',
            'salario' => 26000,
            'años_experiencia' => 4
        ],
        'E005' => [
            'nombre' => 'Roberto Gil',
            'salario' => 29000,
            'años_experiencia' => 6
        ]
    ],
    'logistica' => [
        'E006' => [
            'nombre' => 'Elena Moreno',
            'salario' => 24000,
            'años_experiencia' => 3
        ],
        'E007' => [
            'nombre' => 'David Castro',
            'salario' => 27000,
            'años_experiencia' => 5
        ]
    ]
];

// ============================================
// PEDIDOS (3 niveles: id -> sección -> datos)
// ============================================
$pedidos = [
    'PED001' => [
        'cliente' => 'C001',
        'productos' => ['P001', 'M001'],
        'estado' => [
            'fecha' => '2024-11-15',
            'estado' => 'entregado',
            'total' => 948.00
        ]
    ],
    'PED002' => [
        'cliente' => 'C002',
        'productos' => ['P002', 'M002', 'T002'],
        'estado' => [
            'fecha' => '2024-11-20',
            'estado' => 'enviado',
            'total' => 1877.00
        ]
    ],
    'PED003' => [
        'cliente' => 'C003',
        'productos' => ['P003'],
        'estado' => [
            'fecha' => '2024-11-25',
            'estado' => 'pendiente',
            'total' => 799.00
        ]
    ],
    'PED004' => [
        'cliente' => 'C004',
        'productos' => ['T001', 'T002'],
        'estado' => [
            'fecha' => '2024-11-28',
            'estado' => 'entregado',
            'total' => 168.00
        ]
    ],
    'PED005' => [
        'cliente' => 'C005',
        'productos' => ['M001', 'M002'],
        'estado' => [
            'fecha' => '2024-12-01',
            'estado' => 'enviado',
            'total' => 748.00
        ]
    ]
];

?>
