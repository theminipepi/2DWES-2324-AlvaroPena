<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $decimal=limpieza($_POST['NumDecimal']);
    $conversion = limpieza($_POST['conversion']);
    //calcular();
    $binario=binario($decimal);
    $octal=octal($decimal);
    $hexadecimal=hexadecimal($decimal);
    pintar($binario,$octal,$hexadecimal,$conversion,$decimal);

    
}
function binario($decimal){
    $binario=decbin($decimal);
    return $binario;
}
function octal($decimal){
    $octal=decoct($decimal);
    return $octal;
}
function hexadecimal($decimal){
    $hexadecimal=dechex($decimal);
    return $hexadecimal;
}

function pintar($binario,$octal,$hexadecimal,$conversion,$decimal){
    echo "<label for=Numdecimal>Numero Decimal </label>";
    echo "<input type=text name=Numdecimal value='$decimal'>";
    if($conversion=='Binario'){
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>Binario</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>$binario</td>";
        echo "</tr>";
        echo "</table>";
    }
    if($conversion=='Octal'){
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>Octal</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>$octal</td>";
        echo "</tr>";
        echo "</table>";
    }
    if($conversion=='Hexadecimal'){
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>Hexadecimal</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>$hexadecimal</td>";
        echo "</tr>";
        echo "</table>";
    }
    if($conversion=='Todos Sistemas'){
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>Binario</td>";
        echo "<td>Octal</td>";
        echo "<td>Hexadecimal</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>$binario</td>";
        echo "<td>$octal</td>";
        echo "<td>$hexadecimal</td>";
        echo "</tr>";
        echo "</table>";
        
    }
}
function limpieza($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }