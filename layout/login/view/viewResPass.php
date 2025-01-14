<?php

// Función para generar el formulario
function generarFormulario() {
    return '
    <link rel="stylesheet" href="public/css/paleta.css">
    <link rel="stylesheet" href="public/css/registro.css">
    
    <body>
        <div class="main-content">
            <div class="formulario">
                <h1>Restaura tu contraseña</h1>
                <form action="/submit" method="post">
                    <!-- Correo -->
                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required>

                    <!-- Contraseña -->
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>

                    <!-- Botón de envío -->
                    <button type="submit">Restaurar</button>
                </form>
            </div>
        </div>
    </body>
    ';
}

// Llamar a la función para mostrar el formulario
echo generarFormulario();

?>

