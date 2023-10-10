<?php
if($_SERVER['REQUEST_METHOD']=='POST'){

function calcular(){

    $decimal=$Decimal=$_POST['NumDecimal'];

    if($_POST['conversion']=='Binario'){
        $binario=binario($decimal);
    }
    if($_POST['conversion']=='Octal'){
        $octal=octal($decimal);
    }
    if($_POST['conversion']=='Hexadecimal'){
        $hexadecimal=hexadecimal($decimal);
    }
    if($_POST['conversion']=='Todos Sistemas'){
        $binario=binario($decimal);
        $octal=octal($decimal);
        $hexadecimal=hexadecimal($decimal);
    }

}
}
function binario($decimal){
    $binario=decbin($decimal);
    return $binario;
}
function octal($decimal){
    $octal=octdec($decimal);
    return $octal;
}
function hexadecimal($decimal){
    $hexadecimal=dechex($decimal);
    return $hexadecimal;
}

function pintar(){
    if($_POST['conversion']=='Binario'){
        echo "<tr>";
        echo "<td>$binario</td>";
        echo "</tr>";
    }
    if($_POST['conversion']=='Octal'){
        echo "<tr>";
        echo "<td>$octal</td>";
        echo "</tr>";
    }
    if($_POST['conversion']=='Hexadecimal'){
        echo "<tr>";
        echo "<td>$hexadecimal</td>";
        echo "</tr>";
    }
    if($_POST['conversion']=='Todos Sistemas'){
        echo "<tr>";
        echo "<td>$binario</td>";
        echo "<td>$octal</td>";
        echo "<td>$hexadecimal</td>";
        echo "</tr>";
        
    }
}


