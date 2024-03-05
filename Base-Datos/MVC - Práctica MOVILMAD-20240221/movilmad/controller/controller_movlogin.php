<?php
    include '../model/model_movlogin.php';
    include './controller_functions.php';


    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);

    //comprobamos que estan bien los datos del login.
    $valid=M_LoginData($email,$password);

    if ($valid==false) {
        header ('location:./ERROR_movlogin.php');
    }else{
        //el carrito será un array vacio.
        $carrito=array();   

        //lo pasamos a string con serialize.
        $carrito = serialize($carrito);

        //si la cookie no esta creada, la crea.
        if (!isset($_COOKIE['carrito'])) {
            setcookie('carrito', $carrito, time() + (86400 * 30), "/");
        }

        //creamos la cookie del usuario
        setcookie('usuario', $email, time() + (86400 * 30), "/");
        session_start();
        //llevamos a welcome
        header ('location:../view/movwelcome.php');
        
    }
    
    ?>