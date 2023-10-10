<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de Base</title>
</head>
<body>
    <form name="cambioBase" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="Num">Número</label>
        <input type="text" name="Num"><br>
        <label for="base">Nueva Base</label>
        <input type="text" name="base2"><br>
        <input type="submit" name="Enviar" value="Enviar">
        <input type="reset" name="Borrar" value="Borrar">
    </form>
</body>
</html>
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