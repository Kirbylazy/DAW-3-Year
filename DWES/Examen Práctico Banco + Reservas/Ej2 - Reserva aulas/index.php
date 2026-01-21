<?php



    // Procesar inicio de sesión, si hace bien login va a principal, si falla se queda en index.
        //Puedes hacerlo aquí o llamar a la función 
        iniciarSesion($email, $password)

    // PROCESAR BOTÓN REGISTRO, VA A REGISTRO

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Reservas de Aulas</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <table>
        <tr>
            <th colspan="2">Sistema de Reservas de Aulas</th>
        </tr>
    </table>


    
    <!-- MENSAJES INFORMATIVOS -->


    
    <form method="post" action="">
        <table>
            <tr>
                <th colspan="2">Iniciar Sesión</th>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="email" required></td>
            </tr>
            <tr>
                <td><label for="password">Contraseña:</label></td>
                <td><input type="password" id="password" name="password" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="login" value="Iniciar Sesión">
                    <input type="submit" name="registro" value="Registrarse" formnovalidate>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>