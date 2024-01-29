<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Acceso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .panel {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        a {
            display: block;
            margin-bottom: 10px;
            text-decoration: none;
            padding: 8px;
            background-color: #4caf50;
            color: #fff;
            border-radius: 4px;
            text-align: center;
        }

        a:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="panel">
        <h2>Panel de Acceso</h2>
        <a href="./pe_altaped.php">Realizar un Pedido</a>
        <a href="./pe_consped.php">Consulta Información de Pedidos</a>
        <a href="./pe_consprodstock.php">Consulta Stock</a>
        <a href="./pe_constock.php">Consulta Stock por Linea Producto</a>
        <a href="./pe_topprod.php">Entre Fechas</a>
        <a href="./pe_conspago.php">Relacion de Pagos</a>
    </div>
</body>

</html>
