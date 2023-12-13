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

        $dni = $_POST['empleado'];
        $cod_dpto = $_POST['departamento'];

        // Actualizamos la tabla de emple_depart
        $borrarEmpleado = $conn->prepare("UPDATE emple_depart set cod_dpto = '$cod_dpto' Where dni = '$dni'");
        $borrarEmpleado->execute();

    echo "Datos actualizados correctamente";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
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
        
        <label for="empleado">DNI Empleado: </label>
        <select name="empleado" class="form-control">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "rootroot";
            $dbname = "webemple";
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    // Establecer el modo de error de PDO a excepción
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                    $dni = $_POST['dni'];
            
                    // Obtener los departamentos
                    $stmtEmpleado = $conn->prepare("SELECT dni FROM empleado");
                    $stmtEmpleado->execute();
                    $Empleado = $stmtEmpleado->fetchAll();
            foreach($Empleado as $dni){
                echo "<option value=".$dni['dni'].">".$dni['dni']."</option>";
            }
        ?>
        </select>
        <br>
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
