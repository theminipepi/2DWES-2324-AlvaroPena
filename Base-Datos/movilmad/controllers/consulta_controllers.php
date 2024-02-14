<?php
session_start();
if(!(isset($_SESSION['usuario']))){
      header("Location: ../index.php");
 }
require_once("../models/consulta_models.php");

if (isset($_POST['Consultar'])) {

    require_once("limpiar_controllers.php");
    $fechadesde = limpiar($_POST['fechadesde']);
    $fechahasta = limpiar($_POST['fechahasta']);

    $vehiculos = listadoVehiculos($_SESSION['idcliente'],$fechadesde,$fechahasta);
    require_once("./movconsultar_controllers.php");
    
}

if (isset($_POST['Volver'])) {
    header("Location: ../views/movwelcome.php");
}

    
?>