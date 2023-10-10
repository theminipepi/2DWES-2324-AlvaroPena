<?php
if($_SERVER['REQUEST_METHOD']=='POST'){

    $cadenaOriginal=limpieza($_POST['ip']);
    $cadena=explode(".",$cadenaOriginal);
    $num1=decbin($cadena[0]);
    $num2=decbin($cadena[1]);
    $num3=decbin($cadena[2]);
    $num4=decbin($cadena[3]);
    pintar($num1,$num2,$num3,$num4,$cadenaOriginal);
}

function pintar($num1,$num2,$num3,$num4,$cadenaOriginal){
    echo "<label for=ipDecimal>Numero Decimal </label>";
    echo "<input type=text name=ipDecimal value='$cadenaOriginal'><br><br>";
    echo "<label for=ipBinario>Ip Binario </label>";
    echo "<input type=text name=ipBinario value='$num1 . $num2 . $num3 . $num4'><br><br>";
}

function limpieza($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }