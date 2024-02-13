<?php
    require_once("limpiar_controllers.php");
//Llamada al modelo -- Intermediario entre vista y modelo !!!

    $usuario = limpiar($_POST['email']);
    $clave = limpiar($_POST['password']);

    require_once("../models/mov_models.php");

    $valorLogin=login($usuario,$clave);

    if($valorLogin == null){
        header("Location: ../index.php");
    }else{
        session_start();
        $_SESSION['usuario']=$valorLogin['nombre'];
        $_SESSION['apellido'] = $valorLogin['apellido'];
        $_SESSION['idcliente'] = $valorLogin['idcliente'];
        header("Location: ../views/movwelcome.php");
    }
?>