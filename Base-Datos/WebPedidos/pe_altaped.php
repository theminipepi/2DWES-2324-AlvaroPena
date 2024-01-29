<?php
include "funciones.php";
$conn = conexion();
session_start();
if(!isset($_SESSION['usuario'])){
    echo "Sesion incorrecta";
    header("Location: comlogincli.php");
}

if (!isset($_SESSION['cesta'])) {
    $_SESSION['cesta'] = array();
}

function validarNumeroTarjeta($numeroTarjeta) {
    // Validar el formato del número de tarjeta
    return preg_match('/^[A-Za-z]{2}\d{5,}$/', $numeroTarjeta);
}

try {

    if (isset($_COOKIE['cesta_' . $_SESSION['usuario']])) {
        $cestaSerializada = $_COOKIE['cesta_' . $_SESSION['usuario']];
        $_SESSION['cesta'] = unserialize($cestaSerializada);
    }

    $stmtProductos = $conn->prepare("SELECT productName FROM products WHERE quantityInStock > 0");
    $stmtProductos->execute();
    $result = $stmtProductos->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['anadirCesta'])) {
            $productName = $_POST['productName'];
            $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 0;
            $pago = $_POST['pago'];

            // Verificar si la cantidad es válida (mayor que cero)
            if ($cantidad > 0) {
                // Verificar si hay suficiente stock
                $stmtStock = $conn->prepare("SELECT quantityInStock FROM products WHERE productName = :productName");
                $stmtStock->bindParam(':productName', $productName);
                $stmtStock->execute();
                $stock = $stmtStock->fetchColumn();

                if ($cantidad <= $stock) {
                    // Verificar si el producto ya está en la cesta
                    $productoEnCesta = array_search($productName, array_column($_SESSION['cesta'], 'producto'));

                    if ($productoEnCesta !== false) {
                        // Si hay producto, incrementamos la cantidad
                        $_SESSION['cesta'][$productoEnCesta]['cantidad'] += $cantidad;
                    } else {
                        // Si no hay producto, lo agregamos
                        $_SESSION['cesta'][] = array(
                            'producto' => $productName,
                            'cantidad' => $cantidad,
                        );
                    }
                } else {
                    echo "<script>alert('No hay suficiente stock para la cantidad seleccionada.');</script>";
                }
            } else {
                echo "<script>alert('La cantidad debe ser mayor que cero.');</script>";
            }
        }

        // Serializar y guardar la cesta en la cookie
        $cestaSerializada = serialize($_SESSION['cesta']);
        setcookie('cesta_' . $_SESSION['usuario'], $cestaSerializada, time() + 3600, "/");

        if (isset($_POST['realizarCompra'])) {
            try {
                $pago = $_POST['pago'];

                if (!validarNumeroTarjeta($pago)) {
                    echo "<script>alert('El formato del número de tarjeta no es válido.');</script>";
                } else {
                    // Obtener el próximo número de orden
                    $stmtultimaOrden = $conn->query("SELECT * FROM orders ORDER BY orderNumber DESC LIMIT 1");
                    $ultimaOrden = $stmtultimaOrden->fetch(PDO::FETCH_ASSOC);

                    // Obtener el próximo número de orden
                    $siguienteNumero = $ultimaOrden['orderNumber'] + 1;

                    $estadoDefecto = 'Enviado';

                    // Insertar un nuevo pedido en la tabla 'orders' con el próximo número de orden
                    $stmtInsertOrder = $conn->prepare("INSERT INTO orders (orderNumber, orderDate, requiredDate, shippedDate, CustomerNumber, status) VALUES (:orderNumber, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL, :CustomerNumber, :status)");
                    $stmtInsertOrder->bindParam(':orderNumber', $siguienteNumero);
                    $stmtInsertOrder->bindParam(':CustomerNumber', $_SESSION["usuario"]);
                    $stmtInsertOrder->bindParam(':status', $estadoDefecto);
                    $stmtInsertOrder->execute();

                    $totalImporte = 0;

                    foreach ($_SESSION['cesta'] as $item) {
                        $productName = $item['producto'];
                        $cantidad = intval($item['cantidad']);

                        $stmtPrecio = $conn->prepare("SELECT buyPrice FROM products WHERE productName = :productName");
                        $stmtPrecio->bindParam(':productName', $productName);
                        $stmtPrecio->execute();
                        $precio = $stmtPrecio->fetchColumn();

                        $totalImporte += $precio * $cantidad;
                    }

                    $fechaPago = date("Y-m-d H:i:s");

                    $stmtInsertPayment = $conn->prepare("INSERT INTO payments (customerNumber, checkNumber, paymentDate, amount) VALUES (:CustomerNumber, :checkNumber, :paymentDate, :amount)");
                    $stmtInsertPayment->bindParam(':CustomerNumber', $_SESSION["usuario"]);
                    $stmtInsertPayment->bindParam(':checkNumber', $pago);
                    $stmtInsertPayment->bindParam(':paymentDate', $fechaPago);
                    $stmtInsertPayment->bindParam(':amount', $totalImporte);
                    $stmtInsertPayment->execute();

                    // Actualizar el stock de cada producto en la cesta
                    foreach ($_SESSION['cesta'] as $item) {
                        $productName = $item['producto'];
                        $cantidad = intval($item['cantidad']);

                        $stmtUpdateStock = $conn->prepare("UPDATE products SET quantityInStock = quantityInStock - :cantidad WHERE productName = :productName");
                        $stmtUpdateStock->bindParam(':productName', $productName);
                        $stmtUpdateStock->bindParam(':cantidad', $cantidad);
                        $stmtUpdateStock->execute();
                    }

                    $_SESSION['compraExitosa'] = true;
                    $_SESSION['numeroPedido'] = $siguienteNumero;

                    // Redirigir para evitar el reenvío del formulario
                    header("Location: ".$_SERVER['PHP_SELF']);
                    exit();
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        if (isset($_POST['borrarCesta'])) {
            // Limpiar la cesta y eliminar la cookie
            $_SESSION['cesta'] = array();
            setcookie('cesta_' . $_SESSION['usuario'], $cestaSerializada, time() - 3600, "/");
        }
    }
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
    <title>Bienvenido</title>
</head>
<body>
    <a href="./pe_login.php" class="cerrar-button">Cerrar Sesión</a>
    <a href="./pe_inicio.php" class="inicio-button">Inicio</a> 
    <div class="login-container">
        <p>Bienvenido, <?php echo $_SESSION["usuario"]; ?>!</p>
        <h2>Web de Compras</h2>
        <form class="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="productName">Selecciona un producto para añadir a la cesta:</label>
            <br>
            <select name='productName'>
                <?php foreach ($result as $fila): ?>
                    <option value="<?php echo $fila['productName']; ?>"><?php echo $fila['productName']; ?></option>
                <?php endforeach; ?>
            </select>
            <br><br>
            <label for="cantidad">Introduzca una cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" required>
            <br><br>
            <button type="submit" name="anadirCesta">Añadir a la cesta</button>
        </form>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <button type="submit" name="borrarCesta" class="borrar-button">Borrar Cesta</button>
        </form>
        <div class="cesta-container">
            <h3>Productos en la Cesta:</h3>
            <?php if (isset($_SESSION['cesta']) && !empty($_SESSION['cesta'])): ?>
                <?php foreach ($_SESSION['cesta'] as $item): ?>
                <div class="cesta-item">
                    <?php echo $item['producto']; ?> (Cantidad: <?php echo $item['cantidad']; ?>)
                </div>
            <?php endforeach; ?>
            <?php else: ?>
                <p>No hay productos en la cesta.</p>
            <?php endif; ?>
        </div>
        <div class="realizar-compra-container">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="pago"> Numero de Tarjeta:</label>
            <input type="text" id="pago" name="pago" placeholder="AA99999"equired>
            <br><br>
            <button type="submit" name="realizarCompra" class="realizar-compra-button">Realizar Compra</button>
            </form>
        </div>
        <?php if (isset($_SESSION['compraExitosa'])): ?>
            <div class="exito-container">
                <p>¡Compra realizada con éxito!</p>
                <p>Detalles de la compra:</p>
                <ul>
                    <?php foreach ($_SESSION['cesta'] as $item): ?>
                        <li><?php echo $item['producto']; ?> (Cantidad: <?php echo $item['cantidad']; ?>)</li>
                    <?php endforeach; ?>
                </ul>
                <p>Número de Pedido: <?php echo $_SESSION['numeroPedido']; ?></p>
            </div>
            <?php unset($_SESSION['compraExitosa']); ?>
        <?php endif; ?>
    </div>
    </div>
</body>
</html>