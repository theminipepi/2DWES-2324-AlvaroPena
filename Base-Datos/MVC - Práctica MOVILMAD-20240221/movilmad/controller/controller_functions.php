<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function C_CerrarSesion(){
    if (isset($_COOKIE['usuario'])){
    $email = $_COOKIE['usuario'];
    $carrito = $_COOKIE['carrito'];
    setcookie('usuario', $email, time() - (86400 * 30), "/"); 
    setcookie('carrito', $carrito, time() - (86400 * 30), "/");
}
}

function C_UserCookie(){
    if (!isset($_COOKIE['usuario'])) {
        header ('location:movlogin.php');
    }
}

?>