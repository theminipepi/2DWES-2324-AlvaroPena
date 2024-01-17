<?php
session_start();
if(!isset($_SESSION['usuario'])){
    echo "Sesion incorrecta";
    header("Location: comlogincli.php");
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
     
    <a href="./comprocli.php" tittle="compras">
    <img src='./Imagenes/Carrito.png' alt="compras">
    </a>
    <br>
    <a href="./comconscli.php">Consulta de Compras</a>
    <br><br>
    <input type="submit" value="Cerrar Sesion">
    </form>
</body>
</html>
<?php
/*Inserción en tabla Prepared Statement- mysql PDO*/
if ($_SERVER['REQUEST_METHOD']=='POST') {

    include "funciones.php";

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