<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        
        <br><br>
        <label for="fecha">Introduce una Fecha: 
        <input type="datetime" name="fecha"></input>
        <br><br>
        <input type="submit" value="enviar">
        <br>
    </form>
</body>
</html>
<?php
/*Inserción en tabla Prepared Statement- mysql PDO*/
if ($_SERVER['REQUEST_METHOD']=='POST') {
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "webemple";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Establecer el modo de error de PDO a excepción
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $fecha = $_POST['fecha'];
        
        // Obtenemos el salario del empleado
        $stmDNIEmpleado = $conn->prepare("SELECT dni FROM emple_depart WHERE fecha_ini < $fecha and (fecha_fin > $fecha or  fecha_fin is null)");
        $stmDNIEmpleado->execute();
        $DNIEmpleado = $stmDNIEmpleado->fetchAll();
        var_dump($DNIEmpleado);
        foreach ($DNIEmpleado as $value => $dni) {
           $dni = $DNIEmpleado[$value]['dni'];
           echo $dni;
            $stmNombreEmpleado = $conn->prepare("SELECT nombre FROM empleado WHERE dni = '$dni'");
            $stmNombreEmpleado->execute();
            $NombreEmpleado = $stmNombreEmpleado->fetchAll(PDO::FETCH_ASSOC);
            var_dump($NombreEmpleado);
        }
        
        
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
}
?>

