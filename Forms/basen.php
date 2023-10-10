<?php
if($_SERVER['REQUEST_METHOD']=='POST'){

    $numero=limpieza($_POST['Num']);
    $numBase=explode("/",$numero);
    $num=$numBase[0];
    $base=$numBase[1];
    $base2 = limpieza($_POST['base2']);
    $nuevo=convertirBase($num,$base,$base2);
    pintar($nuevo,$num,$base,$base2);
}
function convertirBase($num,$base,$base2){
    $nuevoNum = base_convert($num,$base,$base2);
    return $nuevoNum;
}
function pintar($nuevo,$num,$base,$base2){
    echo "El número $num en base $base , en base $base2 es $nuevo";
}

function limpieza($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }