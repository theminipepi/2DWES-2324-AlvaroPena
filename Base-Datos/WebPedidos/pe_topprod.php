<?php
include "funciones.php";
$conn = conexion();
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
    <label for="fechaIni">Desde:
    <input type="date" name="fechaIni"></input>
    <br><br>
    <label for="fechaFin">Hasta:
    <input type="date" name="fechaFin"></input>
    <input type="submit" value="enviar">
</form>
</body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD']=='POST') {
    try {
       
        $fecha_ini = $_POST['fechaIni'];
        $fecha_fin = $_POST['fechaFin'];
        $nombre_producto = entrefechas($conn,$fecha_ini,$fecha_fin);
        var_dump($nombre_producto);
        $productos=ordenes($conn,$nombre_producto);
        foreach($productos as $nombre){
            echo $nombre['productName']." se han comprado ". $nombre['total']." unidades";
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
