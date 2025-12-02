# Ejercicios de Arrays en PHP

## Descripción General
Esta colección contiene 20 ejercicios progresivos sobre manipulación de arrays en PHP, organizados en 4 niveles de dificultad. Cada ejercicio incluye:
- Un archivo PHP con formulario HTML
- Una función en `funciones.php` que debe implementarse
- Datos de prueba en `datos.php`

---

## Datos Disponibles

Los ejercicios utilizan los siguientes arrays multinivel definidos en `datos.php`:

- **`$productos`**: Catálogo de productos organizados por categoría
  - Cada producto tiene: nombre, precio, stock, valoración

- **`$clientes`**: Array de clientes
  - Cada cliente tiene: nombre, idiomas (con niveles), compras (array de IDs de productos)

- **`$empleados`**: Empleados organizados por departamento
  - Cada empleado tiene: nombre, salario

- **`$proveedores`**: Array de proveedores
  - Cada proveedor tiene: datos (tipo: nacional/internacional), productos (array de IDs)

---

## NIVEL 1 - BÁSICO (Funciones individuales simples)

### Ejercicio 1: Contar productos por categoría
**Función PHP:** `count`
**Función a implementar:** `contarProductosPorCategoria(array $productos, string $categoria): int`

**Frontend:**
- Formulario con select de categorías (generado dinámicamente con `obtenerCategorias()`)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Tabla con todos los productos de la categoría seleccionada
- Columnas: ID, Nombre, Precio, Stock, Valoración
- Total de productos al final

---

### Ejercicio 2: Contar idiomas de un cliente
**Función PHP:** `count`
**Función a implementar:** `contarIdiomasCliente(array $clientes, string $idCliente): int`

**Frontend:**
- Formulario con select de clientes (generado dinámicamente con `obtenerIdsClientesAux()`)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Tabla con todos los idiomas del cliente
- Columnas: Idioma, Nivel
- Total de idiomas al final

---

### Ejercicio 3: Verificar si cliente compró producto
**Función PHP:** `in_array`
**Función a implementar:** `clienteComproProducto(array $clientes, string $idCliente, string $idProducto): bool`

**Frontend:**
- Formulario con:
  - Select de clientes (generado dinámicamente)
  - Input text para ID de producto
- Botón "Ejecutar"

**Resultado a mostrar:**
- Mensaje indicando si el cliente SÍ o NO compró el producto
- Tabla con todas las compras del cliente

---

### Ejercicio 4: Obtener IDs de clientes
**Función PHP:** `array_keys`
**Función a implementar:** `obtenerIdsClientes(array $clientes): array`

**Frontend:**
- Formulario con solo botón "Ejecutar"

**Resultado a mostrar:**
- Lista de todos los IDs de clientes

---

### Ejercicio 5: Precio máximo de una categoría
**Función PHP:** `max`
**Función a implementar:** `obtenerPrecioMaximoCategoria(array $productos, string $categoria): float`

**Frontend:**
- Formulario con select de categorías (generado dinámicamente)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Mensaje con el precio máximo
- Tabla con todos los productos y sus precios de la categoría

---

## NIVEL 2 - BÁSICO-INTERMEDIO (Funciones individuales con más navegación)

### Ejercicio 6: Contar compras por cliente
**Funciones PHP:** `count` + `foreach`
**Función a implementar:** `contarComprasPorCliente(array $clientes): array`

**Frontend:**
- Formulario con solo botón "Ejecutar"

**Resultado a mostrar:**
- Tabla con todos los clientes
- Columnas: ID Cliente, Cantidad de Compras, Productos Comprados

---

### Ejercicio 7: Idiomas por nivel de un cliente
**Funciones PHP:** `foreach` + condicionales
**Función a implementar:** `obtenerIdiomasPorNivel(array $clientes, string $idCliente, string $nivel): array`

**Frontend:**
- Formulario con:
  - Select de clientes (generado dinámicamente)
  - Input text para nivel (ej: nativo, C1, B2, A2)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Lista de idiomas del cliente con ese nivel
- Tabla con todos los idiomas del cliente para contexto

---

### Ejercicio 8: Salario mínimo de un departamento
**Función PHP:** `min`
**Función a implementar:** `obtenerSalarioMinimoDepartamento(array $empleados, string $departamento): int`

**Frontend:**
- Formulario con select de departamentos (generado dinámicamente con `obtenerDepartamentos()`)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Mensaje con el salario mínimo
- Tabla con todos los empleados del departamento
- Columnas: ID Empleado, Nombre, Salario

---

### Ejercicio 9: Productos no comprados por cliente
**Función PHP:** `array_diff`
**Función a implementar:** `obtenerProductosNoComprados(array $productos, array $clientes, string $idCliente): array`

**Frontend:**
- Formulario con select de clientes (generado dinámicamente)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Tabla con productos NO comprados por el cliente
- Total de productos sin comprar

---

### Ejercicio 10: Reindexar idiomas de cliente
**Función PHP:** `array_values`
**Función a implementar:** `reindexarIdiomasCliente(array $clientes, string $idCliente): array`

**Frontend:**
- Formulario con select de clientes (generado dinámicamente)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Tabla de niveles de idiomas reindexados desde 0
- Columnas: Índice, Nivel

---

## NIVEL 3 - INTERMEDIO (Combinando 2 funciones)

### Ejercicio 11: Productos únicos de proveedores
**Función PHP:** `array_unique`
**Función a implementar:** `obtenerProductosUnicos(array $proveedores): array`

**Frontend:**
- Formulario con solo botón "Ejecutar"

**Resultado a mostrar:**
- Tabla con productos únicos suministrados por todos los proveedores
- Total de productos únicos

---

### Ejercicio 12: Contar categorías de productos
**Funciones PHP:** `array_keys` + `count`
**Función a implementar:** `contarCategorias(array $productos): int`

**Frontend:**
- Formulario con solo botón "Ejecutar"

**Resultado a mostrar:**
- Número total de categorías
- Tabla con categorías y cantidad de productos en cada una

---

### Ejercicio 13: Empleado mejor pagado
**Funciones PHP:** `max` + `foreach`
**Función a implementar:** `obtenerEmpleadoMejorPagado(array $empleados, string $departamento): string`

**Frontend:**
- Formulario con select de departamentos (generado dinámicamente)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Nombre del empleado mejor pagado
- Tabla con todos los empleados del departamento

---

### Ejercicio 14: Productos sin vender
**Funciones PHP:** `array_diff` + `count`
**Función a implementar:** `contarProductosSinVender(array $productos, array $clientes): int`

**Frontend:**
- Formulario con solo botón "Ejecutar"

**Resultado a mostrar:**
- Cantidad de productos sin vender
- Tabla con los productos que no han sido comprados

---

### Ejercicio 15: N productos más baratos
**Funciones PHP:** `sort` + `array_slice`
**Función a implementar:** `obtenerProductosMasBaratos(array $productos, string $categoria, int $cantidad): array`

**Frontend:**
- Formulario con:
  - Select de categorías (generado dinámicamente)
  - Input number para cantidad (min: 1, max: 10, default: 2)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Tabla con los N precios más bajos
- Tabla completa con todos los productos ordenados por precio
- Columnas: ID, Nombre, Precio, Stock, Valoración

---

## NIVEL 4 - AVANZADO (Combinando 3+ funciones)

### Ejercicio 16: Ranking de productos más comprados
**Funciones PHP:** `array_count_values` + `arsort`
**Función a implementar:** `obtenerRankingProductos(array $clientes): array`

**Frontend:**
- Formulario con solo botón "Ejecutar"

**Resultado a mostrar:**
- Tabla con ranking de productos
- Columnas: ID Producto, Veces Comprado
- Ordenado de mayor a menor

---

### Ejercicio 17: Idiomas adicionales entre clientes
**Funciones PHP:** `array_diff_key` + `count`
**Función a implementar:** `contarIdiomasAdicionales(array $clientes, string $idCliente1, string $idCliente2): int`

**Frontend:**
- Formulario con:
  - Select para Cliente 1 (generado dinámicamente)
  - Select para Cliente 2 (generado dinámicamente)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Cantidad de idiomas adicionales que habla cliente1 respecto a cliente2

---

### Ejercicio 18: Clientes que compraron producto
**Funciones PHP:** `in_array` + `foreach`
**Función a implementar:** `obtenerClientesPorProducto(array $clientes, string $idProducto): array`

**Frontend:**
- Formulario con input text para ID de producto
- Botón "Ejecutar"

**Resultado a mostrar:**
- Tabla con clientes que compraron el producto
- Columnas: ID Cliente, Nombre
- Total de clientes

---

### Ejercicio 19: Productos exclusivos por tipo proveedor
**Funciones PHP:** `array_diff` + `array_unique`
**Función a implementar:** `obtenerProductosExclusivos(array $proveedores, string $tipo1, string $tipo2): array`

**Frontend:**
- Formulario con:
  - Select para tipo de proveedor 1 (nacional/internacional)
  - Select para tipo de proveedor 2 (nacional/internacional)
- Botón "Ejecutar"

**Resultado a mostrar:**
- Tabla con productos exclusivos del tipo1
- Productos que suministran proveedores tipo1 pero NO tipo2

---

### Ejercicio 20: Estadísticas salariales por departamento
**Funciones PHP:** `max` + `min` + `count`
**Función a implementar:** `calcularEstadisticasSalariales(array $empleados): array`

**Frontend:**
- Formulario con solo botón "Ejecutar"

**Resultado a mostrar:**
- Tabla con estadísticas por departamento
- Columnas: Departamento, Salario Máximo, Salario Mínimo, Total Empleados

---

## Funciones Auxiliares

Estas funciones ya están definidas y deben implementarse para generar opciones dinámicas en los formularios:

### `obtenerCategorias(array $productos): array`
Devuelve un array con todas las categorías de productos (usando `array_keys()`)

### `obtenerIdsClientesAux(array $clientes): array`
Devuelve un array con todos los IDs de clientes (usando `array_keys()`)

### `obtenerDepartamentos(array $empleados): array`
Devuelve un array con todos los departamentos (usando `array_keys()`)

---

## Instrucciones de Implementación

### Para cada ejercicio debes:

1. **Implementar la función en `funciones.php`:**
   - Seguir la firma ya definida
   - Usar las funciones de PHP indicadas
   - Devolver el tipo de dato especificado

2. **Completar el frontend en `ejercicioX.php`:**
   - Añadir código PHP al inicio para procesar el formulario
   - Incluir validaciones con `isset()` y `!empty()`
   - Llamar a la función correspondiente
   - Generar opciones de select dinámicamente cuando sea necesario

3. **Mostrar los resultados:**
   - Usar tablas HTML con borde
   - Incluir títulos descriptivos
   - Mostrar datos adicionales de contexto cuando sea relevante
   - Añadir mensajes de "no hay datos" cuando corresponda

---

## Ejemplo de Estructura de Código

```php
<?php
header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding('UTF-8');

require_once 'datos.php';
require_once 'funciones.php';

// Procesar formulario
if (isset($_POST['submit']) && !empty($_POST['campo'])) {
    $campo = $_POST['campo'];
    $resultado = funcionEjercicio($datos, $campo);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio X - Título</title>
</head>
<body>
    <h1>Ejercicio X: Título</h1>

    <form method="POST">
        <!-- Campos del formulario -->
        <button type="submit" name="submit">Ejecutar</button>
    </form>

    <?php if (isset($resultado)): ?>
        <hr>
        <h2>Resultado</h2>
        <!-- Mostrar resultado en tabla -->
    <?php endif; ?>
</body>
</html>
```

---

## Notas Importantes

- Todos los ejercicios usan `isset($_POST['submit'])` para detectar envío del formulario
- Los select dinámicos deben usar las funciones auxiliares
- Las validaciones usan `!empty()` para campos requeridos
- Usar `isset($resultado)` para mostrar u ocultar la sección de resultados
- Los comentarios `<!-- TODO: -->` indican qué código debe implementarse
- Mantener UTF-8 en todas las respuestas con `header()` y `mb_internal_encoding()`
