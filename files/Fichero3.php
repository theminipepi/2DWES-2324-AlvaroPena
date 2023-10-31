<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fichero2</title>
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

    
    

    $file = fopen("alumnos2.txt", "a");
    $txt = ($nombre."##".$apellido1."##".$apellido2."##".$fecha_nac."##".$localidad);
    fwrite($file,$txt);
    fclose($file);

    
}
?>
</body>
</html>