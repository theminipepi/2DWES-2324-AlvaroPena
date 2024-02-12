<?php
function limpiar($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
//Llamada al modelo -- Intermediario entre vista y modelo !!!


    $usuario = limpiar($_POST['email']);
    $clave = limpiar($_POST['password']);

    require_once("../models/mov_models.php");

    $valorLogin=login($usuario,$clave);
    if($valorLogin == true){
        session_start();
        $_SESSION['usuario']=$usuario;
        header("Location: ../views/movwelcome.php");
    }else{
        header("Location: ../index.php");
    }
?>