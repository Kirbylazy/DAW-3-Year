<!-- ### Ejercicio 15: N productos más baratos
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
- Columnas: ID, Nombre, Precio, Stock, Valoración -->

<?php
include_once ('funciones.php'); 
include_once ('datos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 15 - N productos mas baratos</title>
</head>
<body>
    <h1>Ejercicio 15: N productos mas baratos</h1>

    <form method="POST">
        <label for="categoria">Categoria:</label>
        <select name="categoria" id="categoria" required>
            <?php $ids = obtenerCategorias($productos);
                    foreach ($ids as $id):?>
            <option value="<?= $id ?>"><?= $id ?></option>
            <?php endforeach ?>
        </select>
        <br><br>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" min="1" max="10" value="2" required>
        <br><br>
        <button type="submit" name="submit">Ejecutar</button>
    </form>
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"):

                if (isset($_POST["submit"])):
                $categoria = $_POST['categoria'];
                $cantidad = $_POST['cantidad'];
                $elegidos = obtenerProductosMasBaratos($productos, $categoria, $cantidad)?>
                <table border="1" cellpadding="5"><br><br>
                    <tr>
                        <th>Nombre</th><th>Precio</th>
                    </tr>
                    <?php  
                    foreach ($elegidos as $elegido){ ?>

                    <tr>
                        <td><?= $elegido['nombre']?></td>
                        <td><?= $elegido['precio']?>€</td>
                    </tr>

                    <?php } ?>
        </table>
    <?php endif ?> 
    <?php endif ?> 
</body>
</html>
