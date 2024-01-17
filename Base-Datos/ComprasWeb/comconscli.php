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

    <br><br><br>
    <label for="Desde que Fecha">Fecha:
        <input type="date" name="fechaIni"></input>
    <br><br>
    <label for="Hasta que Fecha">Fecha:
        <input type="date" name="fechaFin"></input>
    <br><br><br>
    <input type="submit" value="Cerrar Sesión" name ="CerrarSesion">
    <input type="submit" value="Ver Compras" name ="ver">
    <?php
    ?>
    </form>
</form>
</body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        include "funciones.php";
        $conn = conexion();
    try {

        $fechaIni = $_POST['fechaIni'];
        $fechaFin = $_POST['fechaFin'];

        if(isset($_POST['CerrarSesion'])){
            cerrarSession();
        }

        if(isset($_POST['ver'])){
            $compras = verCompras($conn, $fechaIni, $fechaFin);
            foreach ($compras as $compra) {
                echo "NIF: " . $compra['nif'] . ", ID Producto: " . $compra['id_producto'] . ", Fecha Compra: " . $compra['fecha_compra'] . ", Unidades: " . $compra['unidades'] . "<br>";
            }
        }
        }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
    $conn = null;
    }
?>