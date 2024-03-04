<?php
    require_once("limpiar_controllers.php");
//Llamada al modelo -- Intermediario entre vista y modelo !!!

    $usuario = limpiar($_POST['usuario']);
    $clave = limpiar($_POST['password']);
    date_default_timezone_set('UTC');
    $hoy = date("d.m.y");

    require_once("../models/mov_models.php");

    $valorLogin=login($usuario,$clave);

    if($valorLogin == null){
        header("Location: ../index.php");
        echo "Usuario o Contraseña Incorrectos";
        setcookie('usuario', '', time() - 3600);
        setcookie(session_name(),'', time() - 3600, '/');
    }else{
        session_start();
        $_SESSION['email']=$valorLogin['email'];
        $_SESSION['usuario'] = $valorLogin['nombre'];
        $_SESSION['apellidos'] = $valorLogin['apellidos'];
        $_SESSION['dni'] = $valorLogin['dni'];
        $_SESSION['fecha'] = $hoy;
        header("Location: ../views/vinicio.php");
    }

    
?>