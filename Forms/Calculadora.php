<?php>
echo "El method que ha usado es: ",$_SERVER['REQUEST_METHOD'],"<br>";
if($_POST['operacion']=='Suma'){
    $signo="+";
}
if($_POST['operacion']=='Resta'){
    $signo="-";
}
if($_POST['operacion']=='Producto'){
    $signo="*";
}
if($_POST['operacion']=='Division'){
    $signo="/";
}

    if($_POST['operacion']=='Suma'){
        $resultado=$_POST['operando1']+$_POST['operando2'];
    }
    if($_POST['operacion']=='Resta'){
        $resultado=$_POST['operando1']-$_POST['operando2'];
    }
    if($_POST['operacion']=='Producto'){
        $resultado=$_POST['operando1']*$_POST['operando2'];
    }
    if($_POST['operacion']=='Division'){
        $resultado=$_POST['operando1']/$_POST['operando2'];
    }