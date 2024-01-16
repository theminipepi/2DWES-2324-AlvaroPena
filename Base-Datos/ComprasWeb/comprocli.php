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
<label for="producto">Productos: </label>
<select name="producto" class="form-control">
        <?php
            include "funciones.php";
            $conn = conexion();
            $producto = producto($conn);
            foreach($producto as $nombre){
                echo "<option value=".$nombre['id_producto'].">".$nombre['nombre']." "." "." "." ".$nombre['precio']."</option>";
            }
        ?>
</select>
<br>
<label for="cantidad">Cantidad:
        <input type="number" name="cantidad"></input>
        <br>
        <br><br>
    <input type="submit" value="Añadir al carrito">
    </form>
</form>
</body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        include "funciones.php";
    try {
        $conn = conexion();
        carrito();
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        añadirObjetoCarro($producto, $cantidad);
        }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
    $conn = null;
    }
?>