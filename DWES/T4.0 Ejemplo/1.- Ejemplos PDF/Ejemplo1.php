<?php
try {
    // Conexión a la base de datos
    $host = 'localhost';
    $dbname = 'tienda';
    $user = 'root';  
    $password = '';    

    // Establecer la conexión PDO
    $mysql = "mysql:host=$host;dbname=$dbname;charset=UTF8";
    $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $conexion = new PDO($mysql, $user, $password);
    
    // Hacer la consulta
    $resultado = $conexion->query('SELECT * FROM clientes');

    // Mostrar los resultados
    if ($resultado->rowCount() > 0) {
        // Si hay filas, mostramos los datos
        echo "<table border='1'>
                <thead>
                    <tr>
                        <th>ID Cliente</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                    </tr>
                </thead>
                <tbody>";
        
        // Recorrer los resultados con fetchAll() para obtener todos los registros
        foreach ($resultado as $row) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['id_cliente']) . "</td>
                    <td>" . htmlspecialchars($row['nombre']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>" . htmlspecialchars($row['telefono']) . "</td>
                    <td>" . htmlspecialchars($row['direccion']) . "</td>
                  </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p>No se encontraron clientes.</p>";
    }

    // Cerrar la conexión
    $conexion = null;

} catch (PDOException $e) {
    // Mostrar mensaje de error
    echo "<p>" . $e->getMessage() . "</p>";
}
?>
