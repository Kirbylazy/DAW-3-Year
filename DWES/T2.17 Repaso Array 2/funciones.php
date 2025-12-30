<?php
// Establecer codificación UTF-8
header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding('UTF-8');

/**
 * FUNCIONES PARA EJERCICIOS DE ARRAYS
 * 20 ejercicios con dificultad incremental
 */

// ============================================
// FUNCIONES AUXILIARES
// ============================================

/**
 * Obtener todas las categorías de productos
 *
 * @param array $productos Array de productos
 * @return array Array con los nombres de las categorías
 */
function obtenerCategorias(array $productos): array {

    return array_keys($productos);
}

/**
 * Obtener todos los IDs de clientes
 *
 * @param array $clientes Array de clientes
 * @return array Array con los IDs de clientes
 */
function obtenerIdsClientesAux(array $clientes): array {

    return array_keys($clientes);
}

/**
 * Obtener todos los departamentos
 *
 * @param array $empleados Array de empleados
 * @return array Array con los nombres de departamentos
 */
function obtenerDepartamentos(array $empleados): array {

    return array_keys($empleados);
}

// ============================================
// NIVEL 1 - BÁSICO (Funciones individuales simples)
// ============================================

/**
 * Ejercicio 1: Contar cuántos productos hay en una categoría específica
 * Función principal: count
 *
 * @param array $productos Array de productos
 * @param string $categoria Nombre de la categoría
 * @return int Cantidad de productos en la categoría
 */
function contarProductosPorCategoria(array $productos, string $categoria): int {
    
    return count($productos[$categoria]);
}

/**
 * Ejercicio 2: Contar cuántos idiomas habla un cliente específico
 * Función principal: count
 *
 * @param array $clientes Array de clientes
 * @param string $idCliente ID del cliente
 * @return int Cantidad de idiomas
 */
function contarIdiomasCliente(array $clientes, string $idCliente): int {
    
    return count($clientes[$idCliente]['idiomas']);
}

/**
 * Ejercicio 3: Verificar si un cliente ha comprado un producto específico
 * Función principal: in_array
 *
 * @param array $clientes Array de clientes
 * @param string $idCliente ID del cliente
 * @param string $idProducto ID del producto
 * @return bool True si lo ha comprado, false si no
 */
function clienteComproProducto(array $clientes, string $idCliente, string $idProducto): bool {
    
    return in_array($idProducto, $clientes[$idCliente]['compras']);
}

/**
 * Ejercicio 4: Obtener todos los IDs de los clientes
 * Función principal: array_keys
 *
 * @param array $clientes Array de clientes
 * @return array Array con los IDs de clientes
 */
function obtenerIdsClientes(array $clientes): array {
    
    return array_keys($clientes);
}

/**
 * Ejercicio 5: Encontrar el precio más alto de todos los productos de una categoría
 * Función principal: max
 *
 * @param array $productos Array de productos
 * @param string $categoria Nombre de la categoría
 * @return float Precio máximo
 */
function obtenerPrecioMaximoCategoria(array $productos, string $categoria): array
{
    $maxProducto = null;

    foreach ($productos[$categoria] as $id => $producto) {
        if ($maxProducto === null || $producto['precio'] > $maxProducto['precio']) {
            $maxProducto = $producto;
            $maxProducto['id'] = $id;
        }
    }

    return $maxProducto;
}

// ============================================
// NIVEL 2 - BÁSICO-INTERMEDIO (Funciones individuales con más navegación)
// ============================================

/**
 * Ejercicio 6: Contar cuántos productos ha comprado cada cliente
 * Funciones principales: count + foreach
 *
 * @param array $clientes Array de clientes
 * @return array Array asociativo [id_cliente => cantidad_productos]
 */
function contarComprasPorCliente(array $clientes): array {
    
    foreach ($clientes as $idCliente => $cliente){

        $buffer [$idCliente]['id'] = $idCliente;
        $buffer [$idCliente]['nCompras'] = count($cliente['compras']);
        $buffer [$idCliente]['productos'] = $cliente['compras'];
    }

    return $buffer;
}

/**
 * Ejercicio 7: Obtener los idiomas que habla un cliente con un nivel específico
 * Funciones principales: foreach + condicionales
 *
 * @param array $clientes Array de clientes
 * @param string $idCliente ID del cliente
 * @param string $nivel Nivel del idioma (ej: 'nativo', 'B2', etc)
 * @return array Array con los nombres de idiomas del nivel especificado
 */
function obtenerIdiomasPorNivel(array $clientes, string $idCliente, string $nivel): array {
    
    return array_keys($clientes[$idCliente]['idiomas'],$nivel);
}

/**
 * Ejercicio 8: Encontrar el salario mínimo de todos los empleados de un departamento
 * Función principal: min
 *
 * @param array $empleados Array de empleados
 * @param string $departamento Nombre del departamento
 * @return int Salario mínimo
 */
function obtenerSalarioMinimoDepartamento(array $empleados, string $departamento): int {
    
    $buffer = [];
    foreach ($empleados[$departamento] as $empleado){
        $buffer[] = $empleado['salario'];
    }

    return min($buffer);
}

/**
 * Ejercicio 9: Obtener los IDs de productos que existen en el catálogo pero que un cliente NO ha comprado
 * Función principal: array_diff
 *
 * @param array $productos Array de productos
 * @param array $clientes Array de clientes
 * @param string $idCliente ID del cliente
 * @return array IDs de productos no comprados por el cliente
 */
function obtenerProductosNoComprados(array $productos, array $clientes, string $idCliente): array {
    
    $idsProductos = array_merge(...array_values(array_map('array_keys', $productos)));
    $idsComprados = $clientes[$idCliente]['compras'];

    return array_values(array_diff($idsProductos, $idsComprados));
}

/**
 * Ejercicio 10: Reindexar numéricamente el array de idiomas de un cliente
 * Función principal: array_values
 *
 * @param array $clientes Array de clientes
 * @param string $idCliente ID del cliente
 * @return array Array de idiomas reindexado desde 0
 */
function reindexarIdiomasCliente(array $clientes, string $idCliente): array {
    
    return array_values($clientes[$idCliente]['idiomas']);
}

// ============================================
// NIVEL 3 - INTERMEDIO (Combinando 2 funciones)
// ============================================

/**
 * Ejercicio 11: Obtener una lista única de todos los productos que venden TODOS los proveedores
 * Funciones principales: array_unique
 *
 * @param array $proveedores Array de proveedores
 * @return array Array con IDs únicos de productos
 */
function obtenerProductosUnicos(array $proveedores): array {

    $productosU = [];
    
    foreach ($proveedores as $proveedor){

        $productosU = array_merge($productosU, $proveedor['productos']);
    }

    return array_values(array_unique($productosU));
}

/**
 * Ejercicio 12: Contar cuántas categorías de productos hay en el catálogo
 * Funciones principales: array_keys + count
 *
 * @param array $productos Array de productos
 * @return int Número de categorías
 */
function contarCategorias(array $productos): int {
    
    return count(array_keys($productos));
}

/**
 * Ejercicio 13: Encontrar el nombre del empleado con el salario más alto de un departamento
 * Funciones principales: max + foreach
 *
 * @param array $empleados Array de empleados
 * @param string $departamento Nombre del departamento
 * @return string Nombre del empleado
 */
function obtenerEmpleadoMejorPagado(array $empleados, string $departamento): string {
    
    $better = null;
    foreach ($empleados[$departamento] as $empleado){
        if ($better == null){
            $better = $empleado;
        }elseif ($better['salario'] <= $empleado['salario']){
            $better = $empleado;
        }
    }

    return $better['nombre'];
}

/**
 * Ejercicio 14: Contar cuántos productos NO ha comprado NINGÚN cliente
 * Funciones principales: array_diff + count
 *
 * @param array $productos Array de productos
 * @param array $clientes Array de clientes
 * @return int Cantidad de productos no comprados
 */
function contarProductosSinVender(array $productos, array $clientes): int {
    $idsComprados = [];
    $idsProductos = array_merge(...array_values(array_map('array_keys', $productos)));
    foreach ($clientes as $cliente){
        $idsComprados = array_merge($idsComprados, $cliente['compras']);
    }
    $idsComprados = array_unique($idsComprados);
    return count(array_diff($idsProductos, $idsComprados));
}

/**
 * Ejercicio 15: Ordenar los precios de una categoría de menor a mayor y obtener los N más baratos
 * Funciones principales: sort + array_slice
 *
 * @param array $productos Array de productos
 * @param string $categoria Nombre de la categoría
 * @param int $cantidad Cantidad de productos a obtener
 * @return array Array con los N precios más bajos
 */
function obtenerProductosMasBaratos(array $productos, string $categoria, int $cantidad): array {
    
    $ordenados = $productos[$categoria];
    uasort($ordenados, fn($a, $b) => $a['precio'] <=> $b['precio']);

    return array_slice($ordenados,0,$cantidad,true);
}

// ============================================
// NIVEL 4 - AVANZADO (Combinando 3+ funciones)
// ============================================

/**
 * Ejercicio 16: Obtener un ranking de los productos más comprados, ordenado de mayor a menor
 * Funciones principales: array_count_values + arsort
 *
 * @param array $clientes Array de clientes
 * @return array Array asociativo [id_producto => cantidad_compras] ordenado
 */
function obtenerRankingProductos(array $clientes): array {

    $pedidos = [];
    
    foreach ($clientes as $cliente){

        $pedidos = array_merge($pedidos, $cliente['compras']);

    }

    $pedidos = array_count_values($pedidos);
    arsort($pedidos);

    return $pedidos;
}

/**
 * Ejercicio 17: Comparar idiomas de dos clientes. ¿Cuántos idiomas adicionales habla uno respecto al otro?
 * Funciones principales: array_diff_key + count
 *
 * @param array $clientes Array de clientes
 * @param string $idCliente1 ID del primer cliente
 * @param string $idCliente2 ID del segundo cliente
 * @return int Cantidad de idiomas adicionales que habla cliente1 respecto a cliente2
 */
function contarIdiomasAdicionales(array $clientes, string $idCliente1, string $idCliente2):int{
    
    $cliente1 = count($clientes[$idCliente1]['idiomas']);
    $cliente2 = count($clientes[$idCliente2]['idiomas']);
    $resultado = $cliente1 - $cliente2;

    return $resultado;

}


/**
 * Ejercicio 18: Crear un array con los IDs de clientes que han comprado un producto específico
 * Funciones principales: in_array + foreach
 *
 * @param array $clientes Array de clientes
 * @param string $idProducto ID del producto a buscar
 * @return array Array con IDs de clientes
 */
function obtenerClientesPorProducto(array $clientes, string $idProducto): array {
    
    $resultado = [];

    foreach($clientes as $cliente => $datos){

        if(in_array($idProducto,$datos['compras'])){

            $resultado[] = [$cliente,$datos['datos']['nombre']];
        }
    }

    return $resultado;
}

/**
 * Ejercicio 19: Productos que suministran proveedores de un tipo pero NO los de otro tipo
 * Funciones principales: array_diff + array_unique
 *
 * @param array $proveedores Array de proveedores
 * @param string $tipo1 Primer tipo de proveedor (ej: 'nacional')
 * @param string $tipo2 Segundo tipo de proveedor (ej: 'internacional')
 * @return array IDs de productos exclusivos del tipo1
 */
function obtenerProductosExclusivos(array $proveedores, string $tipo1, string $tipo2): array {
    
    $array1 = [];
    $array2 = [];

    foreach ($proveedores as $proveedor){

        if ($proveedor['datos']['tipo'] == $tipo1){

            $array1 = array_merge($array1, $proveedor['productos']);

        }elseif ($proveedor['datos']['tipo'] == $tipo2)

            $array2 = array_merge($array2, $proveedor['productos']);
    }

    $resultado = array_diff(array_unique($array1),array_unique($array2));

    return $resultado;
}

/**
 * Ejercicio 20: Para cada departamento calcular: salario max, min y cantidad de empleados
 * Funciones principales: max + min + count
 *
 * @param array $empleados Array de empleados
 * @return array Array con estadísticas por departamento
 */
function calcularEstadisticasSalariales(array $empleados): array {
    
    $resultado = [];

    foreach ($empleados as $departamento => $datos){

        $buffer = [];
        
        foreach ($datos as $empleado){
            $buffer[] = $empleado['salario'];
        }

        $resultado [$departamento] = ['max' => max($buffer),
                                      'min' => min($buffer),
                                      'num' => count($buffer),];
    }

    return $resultado;
}

?>
