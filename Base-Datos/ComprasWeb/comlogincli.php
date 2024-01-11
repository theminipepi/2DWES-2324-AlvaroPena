<?php
/*Inserción en tabla Prepared Statement- mysql PDO*/
if ($_SERVER['REQUEST_METHOD']=='POST') {

    include "funciones.php";

try {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $conn = conexion();
    login($conn, $usuario, $clave);
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
        
        
        <label for="usuario">Usuario: 
        <input type="text" name="usuario"></input>
        <br>
        <label for="clave">Contraseña:
        <input type="text" name="clave"></input>
        <br>
        <input type="submit" value="enviar">
        <br>
    </form>
</body>
</html>
