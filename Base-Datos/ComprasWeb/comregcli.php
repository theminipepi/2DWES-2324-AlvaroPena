<?php
setcookie('usuario', '', time() - 3600);
setcookie(session_name(),'', time() - 3600, '/');
/*Inserción en tabla Prepared Statement- mysql PDO*/
if ($_SERVER['REQUEST_METHOD']=='POST') {

    include "funciones.php";

try {
    
    $nif = $_POST['nif'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cp = $_POST['cp'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $clave = strrev($apellido);

    $conn = conexion();
    añadirCliente($conn, $nif, $nombre, $apellido, $cp, $direccion , $ciudad, $clave);
    
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        
        <label for="nif">DNI: 
        <input type="text" name="nif"></input>
        <br>
        <label for="nombre">Nombre: 
        <input type="text" name="nombre"></input>
        <br>
        <label for="apellido">Apellido:
        <input type="text" name="apellido"></input>
        <br>
        <label for="cp">Código Postal:
        <input type="text" name="cp"></input>
        <br>
        <label for="direccion">Dirección
        <input type="text" name="direccion"></input>
        <br>
        <label for="ciudad">Ciudad:
        <input type="text" name="ciudad"></input>
        <br>
        <input type="submit" value="enviar">
        <br>
    </form>
</body>
</html>
