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
    <select name="linea" class="form-control">
        <?php
            $lineas = nombresLinea($conn);
            foreach($lineas as $linea){
                echo "<option value='".$linea['productLine']."'>".$linea['productLine']."</option>";
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
        $nombre_linea = $_POST['linea'];
        $producto_linea = productosLinea($conn, $nombre_linea);
        echo "Los productos de la linea $nombre_linea son:"."<br>";
        foreach($producto_linea as $producto){
            echo $producto['productName']." hay en stock ".$producto['quantityInStock'];
            echo "<br>";
        }
        }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
    $conn = null;
    }
?>
