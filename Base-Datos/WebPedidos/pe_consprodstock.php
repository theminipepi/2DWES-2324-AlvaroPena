<?php
include "funciones.php";
$conn = conexion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./estilo.css">
    <title>Document</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <select name="producto" class="form-control">
        <?php
            $productos = producto($conn);
            foreach($productos as $producto){
                echo "<option value='".$producto['productName']."'>".$producto['productName']."</option>";
            }
            
        ?>
    </select>
    <input type="submit" value="enviar">
</form>
</body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD']=='POST') {
    try {
        
        $nombre_producto = $_POST['producto'];
        $stock = cantidad($conn, $nombre_producto);
        var_dump($stock);
        echo "La cantidad de $nombre_producto es de $stock";

        }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
    $conn = null;
    }
?>
