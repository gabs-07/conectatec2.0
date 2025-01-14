<link rel="stylesheet" href="public/css/mensajes.css">

<?php

include_once 'includes/user.php';
include_once 'includes/user_session.php';

$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user'])){
    //echo "Hay sesión";
    $user->setUser($userSession->getCurrentUser());
    include_once 'view/user.php';
}else if(isset($_POST['username']) && isset($_POST['password'])){
    //echo "Validación de login";

    $userForm = $_POST['username'];
    $passForm = $_POST['password'];

    if($user->userExists($userForm, $passForm)){
        //echo "usuario validado";
        $userSession->setCurrentUser($userForm);
        $user->setUser($userForm);

        include_once 'view/user.php';
    }else{
        //echo "nombre de usuario y/o password incorrecto";
        $errorLogin = '<p class="mensaje">Nombre de usuario y/o password es incorrectos</p>';

        include_once 'view/login.php';
    }

}else{
    //echo "Login";
    include_once 'view/login.php';
}


?>