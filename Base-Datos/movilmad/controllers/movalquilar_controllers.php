<?php
	session_start();
	if(!(isset($_SESSION['usuario']))){
	  	header("Location: ../index.php");
 	}
	require_once("../controllers/alquiler_controllers.php");
?>
<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a MovilMAD</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
 </head>
   
 <body>
    <h1>Servicio de ALQUILER DE E-CARS</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - ALQUILAR VEHÍCULOS</div>
		<div class="card-body">
	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action="../controllers/movalquilar_controllers.php" method="post">
	
		<B>Bienvenido/a:</B>  <?php echo $_SESSION['usuario']." ".$_SESSION['apellido'] ; ?> <BR><BR>
		<B>Identificador Cliente:</B> <?php echo $_SESSION['idcliente']; ?>  <BR><BR>
		
		<B>Vehiculos disponibles en este momento:</B> <?php date_default_timezone_set('Europe/Madrid'); echo date("d/m/Y H:i"); ?> <BR><BR>
		
			<B>Matricula/Marca/Modelo: </B>
			<select name="vehiculos" class="form-control">
				<?php
				 	require_once("../models/alquiler_models.php");
				 	$vehiculos = vehiculos();
            		foreach($vehiculos as $dato){
	                	echo "<option value='".$dato['matricula']."'>".$dato['matricula']." ".$dato['marca']." ".$dato['modelo']."</option>";
            		}
        		?>
			</select>
			
		
		<BR> <BR><BR><BR><BR><BR>
		<div>
			<input type="submit" value="Agregar a Cesta" name="agregar" class="btn btn-warning disabled">
			<input type="submit" value="Realizar Alquiler" name="alquilar" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->
	<?php
	if(isset($_SESSION['carrito'])){
		foreach($_SESSION['carrito'] as $x){
			echo $x;
			echo "<br>";
		}
	}

	?>
	
  </body>
   
</html>

