<?php
// ============================================
// DATOS DE LOS PROVEEDORES
// ============================================

// Devuelve el inventario inicial del Proveedor A
function obtenerProveedorA(): array {
    return [
        'P001' => ['nombre' => 'Camiseta Tech', 'stock' => 15, 'precio' => 25.99, 'categoria' => 'Ropa'],
        'P002' => ['nombre' => 'Auriculares Bluetooth', 'stock' => 8, 'precio' => 49.99, 'categoria' => 'Audio'],
        'P003' => ['nombre' => 'Mochila USB', 'stock' => 20, 'precio' => 35.50, 'categoria' => 'Accesorios'],
        'P004' => ['nombre' => 'Reloj Inteligente', 'stock' => 5, 'precio' => 120.00, 'categoria' => 'Wearables'],
        'P005' => ['nombre' => 'Gorra LED', 'stock' => 12, 'precio' => 18.99, 'categoria' => 'Ropa']
    ];
}

// Devuelve el inventario inicial del Proveedor B
function obtenerProveedorB(): array {
    return [
        'P002' => ['nombre' => 'Auriculares Bluetooth', 'stock' => 12, 'precio' => 45.00, 'categoria' => 'Audio'],
        'P004' => ['nombre' => 'Reloj Inteligente', 'stock' => 10, 'precio' => 115.00, 'categoria' => 'Wearables'],
        'P006' => ['nombre' => 'Cable USB-C Premium', 'stock' => 50, 'precio' => 12.99, 'categoria' => 'Accesorios'],
        'P007' => ['nombre' => 'Powerbank 20000mAh', 'stock' => 15, 'precio' => 29.99, 'categoria' => 'Accesorios'],
        'P008' => ['nombre' => 'Sudadera Tech', 'stock' => 8, 'precio' => 42.50, 'categoria' => 'Ropa']
    ];
}

// Devuelve el inventario inicial del Proveedor C
function obtenerProveedorC(): array {
    return [
        'P001' => ['nombre' => 'Camiseta Tech', 'stock' => 25, 'precio' => 22.99, 'categoria' => 'Ropa'],
        'P006' => ['nombre' => 'Cable USB-C Premium', 'stock' => 40, 'precio' => 14.50, 'categoria' => 'Accesorios'],
        'P009' => ['nombre' => 'Teclado Mecánico RGB', 'stock' => 6, 'precio' => 89.99, 'categoria' => 'Periféricos'],
        'P010' => ['nombre' => 'Mouse Inalámbrico', 'stock' => 18, 'precio' => 24.99, 'categoria' => 'Periféricos']
    ];
}
?>