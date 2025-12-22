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
$stmt = $pdo->query($sql);
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
        .form-container {
            margin-top: 30px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-container input {
            padding: 8px;
            margin: 5px 0;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-container button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h1>Lista de Clientes</h1>

    <?php if ($stmt->rowCount() > 0): ?>
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
                // Usamos fetch(PDO::FETCH_OBJ) para obtener cada fila como un objeto
                while ($cliente = $stmt->fetch(PDO::FETCH_OBJ)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cliente->id_cliente); ?></td>
                        <td><?php echo htmlspecialchars($cliente->nombre); ?></td>
                        <td><?php echo htmlspecialchars($cliente->email); ?></td>
                        <td><?php echo htmlspecialchars($cliente->telefono); ?></td>
                        <td><?php echo htmlspecialchars($cliente->direccion); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay clientes registrados.</p>
    <?php endif; ?>

    <!-- Formulario para agregar un nuevo cliente -->
    <div class="form-container">
        <h2>Agregar Nuevo Cliente</h2>
        <form action="add_cliente.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="telefono" placeholder="Teléfono" required>
            <input type="text" name="direccion" placeholder="Dirección" required>
            <button type="submit">Agregar Cliente</button>
        </form>
    </div>

</body>
</html>
