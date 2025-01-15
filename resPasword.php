<?php
require_once 'includes/DB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Verificar si las contraseñas coinciden
    if ($password !== $confirmPassword) {
        echo "<p style='color:red;'>Las contraseñas no coinciden.</p>";
    } else {
        try {
            // Conectar a la base de datos
            $db = new DB();
            $conn = $db->connect();

            // Verificar si el correo existe
            $query = $conn->prepare("SELECT * FROM usuario WHERE correo = :email");
            $query->bindParam(':email', $email);
            $query->execute();

            if ($query->rowCount() > 0) {
                // Actualizar la contraseña
                // $hashedPassword = password_hash($password, PASSWORD_BCRYPT); 
                $update = $conn->prepare("UPDATE usuario SET contrasenia = :password WHERE correo = :email");
                $update->bindParam(':password', $password);
                $update->bindParam(':email', $email);
                $update->execute();

                echo "<p style='color:green;'>La contraseña ha sido actualizada correctamente.</p>";
            } else {
                echo "<p style='color:red;'>El correo proporcionado no está registrado.</p>";
            }
        } catch (Exception $e) {
            echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" href="public/css/paleta.css">
    <link rel="stylesheet" href="public/css/registro.css">
</head>
<body>

    <?php  include('layout/login/nav.php');   ?>
    <div class="main-content">
        <div class="formulario">
            <h1>Restablece tu contraseña</h1>
            <form action="resPasword.php" method="post">
                <!-- Correo -->
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required>

                <!-- Nueva contraseña -->
                <label for="password">Nueva contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Ingresa tu nueva contraseña" required>

                <!-- Confirmar contraseña -->
                <label for="confirm_password">Confirma tu contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirma tu nueva contraseña" required>

                <!-- Botón -->
                <button type="submit">Actualizar Contraseña</button>
            </form>
        </div>
    </div>
</body>
</html>
