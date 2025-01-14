<?php
// Función para generar la barra de navegación completa
function generarBarra($user) {
    return '
    <link rel="stylesheet" href="public/css/viewBarra.css">
    <link rel="stylesheet" href="public/css/paleta.css">
    <link rel="stylesheet" href="public/css/index.css">

    <header>
        <div class="left-section">
            <a href="index.php"><img src="src/image/logo.jpg" alt="logo"></a>
            <p>Bienvenid@ ' . htmlspecialchars($user->getNombre()) . '</p>
            <a href="eventoOneIA.php"><p>IA</p></a>
            <a href="eventoOneWeb.php"><p>Desarrollo Web</p></a>
            <a href="eventoOneCs.php"><p>CiberSeguridad</p></a>
            <a href="eventoOneNb.php"><p>Nube</p></a>
            <a href="eventoOneBd.php"><p>Big Data</p></a>            
        </div>

        <div class="right-section">
            <a href="includes/logout.php"><p class="boton">Cerrar sesión</p></a>
        </div>
    </header>
    ';
}

echo generarBarra($user);
?>




