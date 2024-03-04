<?php
	session_start();
	if(!(isset($_SESSION['usuario']))){
	  	header("Location: ../index.php");
 	}

?>
<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>RESERVAS VUELOS</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
 </head>
   
 <body>
   

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Reservar Vuelos</div>
		<div class="card-body">
	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action="../controllers/reservas_controllers.php" method="post">
	
		<B>Email Cliente:</B> <?php echo $_SESSION['email']; ?>   <BR>
		<B>Nombre Cliente:</B>  <?php echo $_SESSION['usuario']." ".$_SESSION['apellidos']; ?>  <BR>
		<B>Fecha:</B> <?php echo $_SESSION['fecha']; ?>   <BR><BR>
		
		<B>Vuelos</B><select name="vuelos" class="form-control">
		<?php
				 	require_once("../models/mov_vuelos.php");
				 	$vuelos = sacarVuelos();
            		foreach($vuelos as $dato){
	                	echo "<option value='".$dato['id_vuelo']."'>".$dato['origen']." ".$dato['destino']." ".$dato['fechahorasalida']." ".$dato['fechahorallegada']." ".$dato['precio_asiento']."</option>";
						
            		}
        		?>
			</select>	
		<BR> 
		<B>Número Asientos</B><input type="number" name="asientos" size="3" min="1" max="100" value="1" class="form-control">
		<BR><BR><BR><BR><BR>
		<div>
			<input type="submit" value="Agregar a Cesta" name="agregar" class="btn btn-warning disabled">
			<input type="submit" value="Comprar" name="comprar" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
		</div>		
	</form>
	
	<!-- FIN DEL FORMULARIO -->

	<?php
	
	if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
		echo "Contenido del carrito:<br>";
		foreach ($_SESSION['carrito'] as $item) {
			echo "ID Vuelo: " . $item['id_vuelo'] . ", Num Asientos: " . $item['num_asientos'] . "<br>";
		}
	} else {
		echo "El carrito está vacío.";
	}

	?>
	<br>

    <a href = "../controllers/sesion_controllers.php">Cerrar Sesion</a>
  </body>
   
</html>

