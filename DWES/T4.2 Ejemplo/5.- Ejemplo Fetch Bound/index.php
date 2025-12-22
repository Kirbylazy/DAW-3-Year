<?php
// Conexión a la base de datos
$host = 'localhost';
$dbname = 'tienda';
$username = 'root';  
$password = '';      

try {
    // Crear la conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establecer manejo de errores
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}

// Consultar la tabla de clientes
$sql = "SELECT * FROM clientes";
$stmt = $pdo->prepare($sql); // Usamos prepare para poder usar bindColumn

$stmt->execute(); // Ejecutamos la consulta

// Vinculamos las columnas a las variables usando bindColumn
$stmt->bindColumn('id_cliente', $id_cliente);
$stmt->bindColumn('nombre', $nombre);
$stmt->bindColumn('email', $email);
$stmt->bindColumn('telefono', $telefono);
$stmt->bindColumn('direccion', $direccion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>

    <h1>Lista de Clientes</h1>

    <?php 
    // Comprobamos si hay filas en la base de datos
    if ($stmt->rowCount() > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID Cliente</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Usamos while para recorrer los resultados con fetch(PDO::FETCH_BOUND)
                while ($stmt->fetch(PDO::FETCH_BOUND)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($id_cliente); ?></td>
                        <td><?php echo htmlspecialchars($nombre); ?></td>
                        <td><?php echo htmlspecialchars($email); ?></td>
                        <td><?php echo htmlspecialchars($telefono); ?></td>
                        <td><?php echo htmlspecialchars($direccion); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay clientes registrados.</p>
    <?php endif; ?>

</body>
</html>
