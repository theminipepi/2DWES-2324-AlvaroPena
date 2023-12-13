<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        
        <label for="departamento">Departamento: </label>
        <select name="departamento" class="form-control">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "rootroot";
            $dbname = "webemple";
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    // Establecer el modo de error de PDO a excepción
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                    $nombre_dpto = $_POST['nombre_dpto'];
            
                    // Obtener los departamentos
                    $stmtDepartamento = $conn->prepare("SELECT cod_dpto, nombre_dpto FROM departamento");
                    $stmtDepartamento->execute();
                    $Departamento = $stmtDepartamento->fetchAll();
            foreach($Departamento as $nombre){
                echo "<option value=".$nombre['cod_dpto'].">".$nombre['nombre_dpto']."</option>";
            }
        ?>
        </select>
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

        $cod_dpto = $_POST['departamento'];
        $nombre_dpto = $_POST['departamento'];

        // Actualizamos la tabla de emple_depart
        $stmtEmpleados = $conn->prepare("SELECT empleado.nombre From emple_depart, empleado Where emple_depart.cod_dpto='$cod_dpto' and emple_depart.dni = empleado.dni");
        $stmtEmpleados->execute();
        $empleados = $stmtEmpleados->fetchAll();
        echo "Los empleados que trabajan en el departamento: ";
        echo "<br>";
        foreach($empleados as $nombre){
            echo $nombre['nombre'];
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

