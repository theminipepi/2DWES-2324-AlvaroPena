<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']);?>" method="POST">
        dni
        <input type="text" name="dni"></input>
    </br>
        nombre
        <input type="text" name="nombre_emple"></input>
    </br>
        salario
        <input type="text" name="salario"></input>
    </br>
        cod_dpto
        <input type="text" name="cod_dpto"></input>
        <input type="submit" value="enivar">
    </form>
    
<?php
/*Inserción en tabla Prepared Statement- mysql PDO*/
if ($_SERVER['REQUEST_METHOD']=='POST') {
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleados1n";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO empleado (dni, nombre_emple, salario, cod_dpto) VALUES (:dni, :nombre_emple, :salario, :cod_dpto)");
    $stmt->bindParam(':dni', $dni);
    $stmt->bindParam(':nombre_emple', $nombre_emple);
    $stmt->bindParam(':salario', $salario);
    $stmt->bindParam(':cod_dpto', $cod_dpto);
  
    // insert a row
    $dni = $_POST['dni'];
    $nombre_emple = $_POST['nombre_emple'];
    $salario = $_POST['salario'];
	$cod_dpto = $_POST['cod_dpto'];
    $stmt->execute();

    echo "New records created successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
}
?>
</body>
</html>
