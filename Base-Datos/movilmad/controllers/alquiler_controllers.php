<?php
require_once("../models/realizaralquiler_models.php");

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    if (isset($_POST['agregar'])) {
        if(count($_SESSION['carrito']) < 3){
            array_push( $_SESSION['carrito'], $_POST['vehiculos']);
        }
            
    }

    if (isset($_POST['vaciar'])) {
        unset($_SESSION['carrito']);
    }

    if(isset($_POST['alquilar'])){
       foreach($_SESSION['carrito'] as $x){
        realizarAlquiler_models($_SESSION['idcliente'], $x);
        header("Location: ../views/movwelcome.php");
       }
    }
    
?>