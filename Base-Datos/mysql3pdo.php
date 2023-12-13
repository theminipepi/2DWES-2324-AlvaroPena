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
        <input type="text" name="nom"></input>
    </br>
        cod
        <input type="text" name="nom"></input>
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
    $stmt = $conn->prepare("INSERT INTO empleados (cod_dpto,nombre_dpto) VALUES (:cod_dpto,:nombre_dpto)");
    $stmt->bindParam(':cod_dpto', $cod_dpto);
    $stmt->bindParam(':nombre_dpto', $nombre);
  
    // insert a row
    $cod_dpto = $_POST['cod'];
	$nombre = $_POST['nom'];
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
