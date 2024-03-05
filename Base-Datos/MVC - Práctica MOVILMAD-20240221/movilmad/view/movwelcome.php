<html>
<?php
		include '../controller/controller_functions.php';
		include '../controller/controller_movwelcome.php';
		C_UserCookie();
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
		<div class="card-header">Menú Usuario - OPERACIONES </div>
		<div class="card-body">


		<B>Bienvenido/a:</B><?php echo $data['nombre'] .' '.$data['apellido']; ?>    <BR><BR>
		<B>Identificador Cliente:</B> <?php echo $data['idcliente']; ?> <BR><BR>
		<B>Hora actual:</B><?php mostrarHora() ?>   <BR><BR>

       <!--Formulario con botones -->
	
		<input type="button" value="Alquilar Vehículo" onclick="window.location.href='../controller/movalquilar.php'" class="btn btn-warning disabled">
		<input type="button" value="Consultar Alquileres" onclick="window.location.href=''" class="btn btn-warning disabled">
		<input type="button" value="Devolver Vehículo" onclick="window.location.href='../controller/movdevolver.php'" class="btn btn-warning disabled">
		</br></br>
		
		
		
		  <BR><a href="../controller/movlogin.php">Cerrar Sesión</a>
	</div>  
	  
	  
     
   </body>
   
</html>


