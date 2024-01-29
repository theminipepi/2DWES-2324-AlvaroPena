<?php
include "funciones.php";
$conn = conexion();
session_start();
if(!isset($_SESSION['usuario'])){
    echo "Sesion incorrecta";
    header("Location: comlogincli.php");
}

try {

    // Obtener el CustomerNumber del usuario actual
    $customerNumber = $_SESSION["usuario"];

    // Consulta para obtener los pedidos del cliente actual
    $stmtPedidos = $conn->prepare("SELECT orderNumber, orderDate, status FROM orders WHERE CustomerNumber = :CustomerNumber");
    $stmtPedidos->bindParam(':CustomerNumber', $customerNumber);
    $stmtPedidos->execute();
    $resultPedidos = $stmtPedidos->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./estilo.css">
    <title>Consulta de Pedidos</title>
</head>
<body>
    <a href="./logout.php" class="cerrar-button">Cerrar Sesión</a>
    <a href="./pe_inicio.php" class="inicio-button">Inicio</a> 
    <div class="consulta-container">
        <h2>Consulta de Pedidos</h2>

        <?php if (!empty($resultPedidos)): ?>
            <?php foreach ($resultPedidos as $pedido): ?>
                <div class="pedido-item">
                    <strong>Número de Pedido:</strong> <?php echo $pedido['orderNumber']; ?><br>
                    <strong>Fecha de Pedido:</strong> <?php echo $pedido['orderDate']; ?><br>
                    <strong>Estado:</strong> <?php echo $pedido['status']; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay pedidos para este cliente.</p>
        <?php endif; ?>
    </div>
</body>
</html>
