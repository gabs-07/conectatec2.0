<?php
    function includeNav(){
        echo '<link rel="stylesheet" href="public/css/viewBarra.css">';
        echo '<link rel="stylesheet" href="public/css/paleta.css">';
        echo '<link rel="stylesheet" href="public/css/index.css">';

        include('view/viewNav.php');
    }

    includeNav();
?>


