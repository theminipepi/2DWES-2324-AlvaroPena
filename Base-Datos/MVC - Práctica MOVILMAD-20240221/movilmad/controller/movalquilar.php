<html>
   <?php
		include '../controller/controller_movwelcome.php';
		include '../controller/controller_functions.php';
		include '../controller/controller_movalquilar.php';
		C_UserCookie();
		$cantidad=ContarCoches($Datas);
   ?>
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
	<form action="./controller_movalquilar.php" method="post">
	
		<B>Bienvenido/a:</B><?php mostrarNombre($data); ?>  <BR><BR>
		<B>Identificador Cliente:</B><?php mostrarID($data); ?>   <BR><BR>
		<B>Hora actual:</B><?php mostrarHora(); $carrito=$_COOKIE['carrito']; $carrito=unserialize($carrito);?> <BR><BR>
		
		<B>Vehiculos disponibles en este momento:</B></B><?php echo $cantidad; ?>   <BR><BR>
		
			<B>Matricula/Marca/Modelo: </B><select name="vehiculos" class="form-control">
			<?php
			VehiDispDesplegable($Datas);
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
	<?php mostrarCesta(); ?>
  </body>
   <?php
 mensaje($CantidadEnAlquiler);
   ?>
</html>

