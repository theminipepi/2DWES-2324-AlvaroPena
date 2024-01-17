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
    <?php
    include "funciones.php";
    
    var_dump($_SESSION['carro']);
    $conn = conexion();

    foreach ($_SESSION['carro'] as $id_producto => $cantidad_producto) {
        echo "ID del producto: $id_producto, Cantidad: $cantidad_producto[0]<br>";
    }
    ?>
    <br><br><br>
    <label for="fecha">Fecha:
        <input type="date" name="fecha"></input>
    <br><br><br>
    <input type="submit" value="Cerrar Sesión" name ="CerrarSesion">
    <input type="submit" value="Realizar Compra" name ="comprar">
    <?php
    ?>
    </form>
</form>
</body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD']=='POST') {
    try {

        $fecha_compra = $_POST['fecha'];
        if(isset($_POST['CerrarSesion'])){
            cerrarSession();
        }
        
        
        if(isset($_POST['comprar'])){
            $nif = sacarNif($conn, $_SESSION['usuario']);
            foreach ($_SESSION['carro'] as $id_producto => $cantidad_producto) {
                $id_producto = $id_producto;
                $cantidad = $cantidad_producto[0];
                comprobarProducto($conn, $id_producto, $cantidad);
                comprar($conn,$nif,$id_producto,$fecha_compra,$cantidad);
            }
            header("Location: compras.php");
        }
        }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
    $conn = null;
    }
?>