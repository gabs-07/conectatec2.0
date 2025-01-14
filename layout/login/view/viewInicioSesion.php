<?php
    $errorLogin = '';

    // Verificar si se ha enviado el formulario de login
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errorLogin = 'Correo o contraseña incorrectos';
    }

    // Función de login con $errorLogin como parámetro
    function login($errorLogin = '') {
        echo '
        <!-- Formulario de login -->
        <div class="formulario">
            <h1>Bienvenido</h1>
            <form action="index.php" method="post" id="login-form">
        ';
        
        if (!empty($errorLogin)) {
            echo '<p class="error">' . htmlspecialchars($errorLogin) . '</p>';
        }

        echo '
                <!-- Correo -->
                <label for="username">Correo electrónico:</label>
                <input type="email" id="username" name="username" placeholder="Ingresa tu correo" required>

                <!-- Contraseña -->
                <label for="password">Contraseña:</label>
                <input type="password" id="login-password" name="password" placeholder="Ingresa tu contraseña" required>

                <a class="olvidado" href="resPasword.php">¿Has olvidado la contraseña?</a>
                <a class="registro" href="registro.php">Quiero registrarme.</a>

                <!-- Botón de envío -->
                <input class="botones" type="submit" value="Iniciar Sesión">
            </form>
        </div>
        ';
    }

    login($errorLogin);
?>
