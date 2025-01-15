<?php
require_once 'includes/DB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar datos del formulario
    $nombre = $_POST['nombre'];
    $apellidoPaterno = $_POST['apellidoPaterno'];
    $apellidoMaterno = $_POST['apellidoMaterno'];
    $correo = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Conectar a la base de datos
        $db = new DB();
        $conn = $db->connect();

        // Validar si el correo ya está registrado
        $query = $conn->prepare("SELECT * FROM usuario WHERE correo = :correo");
        $query->bindParam(':correo', $correo);
        $query->execute();

        if ($query->rowCount() > 0) {
            echo "<p style='color:red;'>El correo ya está registrado.</p>";
        } else {
            // Cifrar la contraseña
            //$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insertar los datos del usuario
            $insert = $conn->prepare("
                INSERT INTO usuario (nombre, apellidoPaterno, apellidoMaterno, rol, correo, contrasenia)
                VALUES (:nombre, :apellidoPaterno, :apellidoMaterno, :rol, :correo, :contrasenia)
            ");
            $rol = 'Usuario'; // Puedes ajustar el rol predeterminado según sea necesario
            $insert->bindParam(':nombre', $nombre);
            $insert->bindParam(':apellidoPaterno', $apellidoPaterno);
            $insert->bindParam(':apellidoMaterno', $apellidoMaterno);
            $insert->bindParam(':rol', $rol);
            $insert->bindParam(':correo', $correo);
            $insert->bindParam(':contrasenia', $password);
            $insert->execute();

            echo "<p style='color:green;'>Usuario registrado correctamente.</p>";
        }
    } catch (Exception $e) {
        echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="public/css/paleta.css">
    <link rel="stylesheet" href="public/css/registro.css">
</head>
<body>
<?php  include('layout/login/nav.php');   ?>

    <div class="main-content">
        <div class="formulario">
            <h1>Bienvenido</h1>d
            <form action="registro.php" method="post">
                <!-- Nombre -->
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>

                <!-- Apellido Paterno -->
                <label for="apellidoPaterno">Apellido Paterno:</label>
                <input type="text" id="apellidoPaterno" name="apellidoPaterno" placeholder="Apellido Paterno" required>

                <!-- Apellido Materno -->
                <label for="apellidoMaterno">Apellido Materno:</label>
                <input type="text" id="apellidoMaterno" name="apellidoMaterno" placeholder="Apellido Materno" required>

                <!-- Correo -->
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required>

                <!-- Contraseña -->
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>

                <!-- Botón de envío -->
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>
</body>
</html>
