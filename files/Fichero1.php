<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fichero1</title>
</head>
<body>
<form name="formulario" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label for="nombre">Nombre<br>
    <input type="text" name="nombre"><br><br>
    <label for="apellido1">Apellido1<br>
    <input type="text" name="apellido1"><br><br>
    <label for="apellido2">Apellido2<br>
    <input type="text" name="apellido2"><br><br>
    <label for="fecha_nac">fecha Nacimiento<br>
    <input type="text" name="fecha_nac"><br><br>
    <label for="localidad">Localidad<br>
    <input type="text" name="localidad"><br><br>
    <input type="submit" value="enviar">

</form>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $nombre = test_input($_POST['nombre']);
    $apellido1 = test_input($_POST['apellido1']);
    $apellido2 = test_input($_POST['apellido2']);
    $fecha_nac = test_input($_POST['fecha_nac']);
    $localidad = test_input($_POST['localidad']);

    $nombre=str_pad($nombre, 40, " ",STR_PAD_RIGHT);
    $apellido1=str_pad($apellido1, 40, " ",STR_PAD_RIGHT);
    $apellido2=str_pad($apellido2, 40, " ",STR_PAD_RIGHT);
    $fecha_nac=str_pad($fecha_nac, 10, " ",STR_PAD_RIGHT);
    $localidad=str_pad($localidad, 26, " ",STR_PAD_RIGHT);
    

    $file = fopen("alumnos1.txt", "a");
    $txt = ($nombre.$apellido1.$apellido2.$fecha_nac.$localidad);
    fwrite($file,$txt);
    fclose($file);

    
}
?>
</body>
</html>