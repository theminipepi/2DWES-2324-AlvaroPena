<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    <form name="calculadora" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="Operando1">Operando1</label>
        <input type="text" name="Operando1"><br>
        <label for="Operando2">Operando2</label>
        <input type="text" name="Operando2"><br>
        <label for="operacion">Selecciona operación</label><br>
        <input type="radio" name="operacion" value="Suma">Suma<br>
        <input type="radio" name="operacion" value="Resta">Resta<br>
        <input type="radio" name="operacion" value="Producto">Producto<br>
        <input type="radio" name="operacion" value="División">División<br>
        <input type="submit" name="Enviar" value="Enviar">
        <input type="reset" name="Borrar" value="Borrar">
    </form>

<?php
if($_SERVER['REQUEST_METHOD']=='POST'){

    if($_POST['operacion']=='Suma'){
        $resultado=$_POST['Operando1']+$_POST['Operando2'];
    }
    if($_POST['operacion']=='Resta'){
        $resultado=$_POST['Operando1']-$_POST['Operando2'];
    }
    if($_POST['operacion']=='Producto'){
        $resultado=$_POST['Operando1']*$_POST['Operando2'];
    }
    if($_POST['operacion']=='Division'){
        $resultado=$_POST['Operando1']/$_POST['Operando2'];
    }

    echo "El resultado de la operación es: ".$resultado;

}
    ?>
</body>
</html>