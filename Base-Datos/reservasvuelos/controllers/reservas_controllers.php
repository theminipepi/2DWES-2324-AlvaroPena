<?php
require_once("../controllers/limpiar_controllers.php");
require_once("../models/mov_vuelos.php");
require_once("../controllers/vreservas.php");

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();

    }

    if (isset($_POST['agregar'])) {
        $asientos = $_POST['asientos'];
        $vuelos = $_POST['vuelos'];
    
        if (isset($_SESSION['carrito'][$vuelos])) {
            // Si el vuelo ya está en el carrito, actualiza el número de asientos
            $_SESSION['carrito'][$vuelos]['num_asientos'] += $asientos;
        } else {
            // Si el vuelo no está en el carrito, agrégalo
            $_SESSION['carrito'][$vuelos] = array(
                'id_vuelo' => $vuelos,
                'num_asientos' => $asientos
            );
            header("Location: ../controllers/vreservas.php");
        }
        var_dump($_SESSION['carrito']);
    }


    if (isset($_POST['vaciar'])) {
        unset($_SESSION['carrito']);
        header("Location: ../controllers/vreservas.php");
    }
    if (isset($_POST['volver'])) {
        header("Location: ../views/vinicio.php");
    }

    if(isset($_POST['comprar'])){

        foreach ($_SESSION['carrito'] as $item) {
            realizarCompra($item['id_vuelo'], $_SESSION['dni'], $item['num_asientos']);
            unset($_SESSION['carrito']);
            //header("Location: ../Redsys/Redsys.php");
		}
    }

    
?>