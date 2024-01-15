<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']);?>" method="POST">
    
    </br>
        
    </br>
        
    </br>
        <label for="dni">dni
        <input type="text" name="dni"></input>
        <br>
        <label for="nombre_emple">nombre_emple
        <input type="text" name="nombre_emple"></input>
        <br>
        <label for="salario">salario
        <input type="text" name="salario"></input>
        <br>
        <label for="fecha_nac">fecha_nac
        <input type="date" name="fecha_nac"></input>
        <br>
        <label for="cod_dpto">cod_dpto
        <input type="text" name="cod_dpto"></input>
        <br>
        <label for="fecha_ini">fecha_ini
        <input type="date" name="fecha_ini"></input>
        <br>
        <label for="fecha_fin">fecha_fin
        <input type="date" name="fecha_fin"></input>
        <br>
        <input type="submit" value="enviar">
        <br>
    </form>
    
<?php
/*Inserción en tabla Prepared Statement- mysql PDO*/
if ($_SERVER['REQUEST_METHOD']=='POST') {
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleadosnn";

    $dni = $_POST['dni'];
    $nombre_emple = $_POST['nombre_emple'];
    $salario = $_POST['salario'];
    $fecha_nac = $_POST['fecha_nac'];
    $cod_dpto = $_POST['cod_dpto'];
    $fecha_ini = $_POST['fecha_ini'];
    $fecha_fin = $_POST['fecha_fin'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO empleado (dni, nombre_emple, salario, fecha_nac) VALUES (:dni, :nombre_emple, :salario, :fecha_nac)");
    $stmt->bindParam(':dni', $dni);
    $stmt->bindParam(':nombre_emple', $nombre_emple);
    $stmt->bindParam(':salario', $salario);
    $stmt->bindParam(':fecha_nac', $fecha_nac);
	
    $stmt->execute();

    echo "Datos introducidos en la tabla Empleado";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO emple_dpto (dni, cod_dpto, fecha_ini, fecha_fin) VALUE (:dni, :cod_dpto, :fecha_ini, :fecha_fin)");
    $stmt->bindParam(':dni', $dni);
    $stmt->bindParam(':cod_dpto', $cod_dpto);
    $stmt->bindParam(':fecha_ini', $fecha_ini);
    $stmt->bindParam(':fecha_fin', $fecha_fin);
  
    
    $stmt->execute();

    echo "Datos introducidos en Emple-dto";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
}
?>
</body>
</html>
