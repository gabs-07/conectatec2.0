<?php
    function includeLogin(){
        echo '<link rel="stylesheet" href="public/css/paleta.css">';
        echo ' <link rel="stylesheet" href="public/css/login.css">';
        echo '<link rel="stylesheet" href="public/css/index.css">';
        
        include('view/viewInicioSesion.php');
    }

    includeLogin();
?>