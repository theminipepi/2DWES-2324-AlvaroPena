<?php
include_once '../model/model_movwelcome.php';
$data=M_UserData();

function mostrarNombre($data){
    echo $data['nombre'].' '.$data['apellido'];
}

function mostrarID($data){
    echo $data['idcliente'];
}

function mostrarHora(){
    date_default_timezone_set('Europe/Madrid');
    echo date('H:i:s');
}

?>