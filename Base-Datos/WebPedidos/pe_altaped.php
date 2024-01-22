<?php
include "funciones.php";
$conn = conexion();
/*session_start();
if(!isset($_SESSION['usuario'])){
    echo "Sesion incorrecta";
    header("Location: comlogincli.php");
}*/

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
        <input type="password" name="clave"></input>
        <br>
        <input type="submit" value="enviar">
        <br>
    </form>
</body>
</html>
<?php
/*Inserción en tabla Prepared Statement- mysql PDO*/
if ($_SERVER['REQUEST_METHOD']=='POST') {

    $orderDate = date('Y-m-d');
    $requiredDate = date('Y-m-d');
    $numPedido = (numPedido($conn)) + 1;
    var_dump($numPedido);
    $usuario = $_SESSION['usuario'];
    $comentario = $_POST['comments'];
    $status = $_POST['status'];

try {
    cerrarSession();
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
}
?>