<?php
    include_once '../model/model_movalquilar.php';
    include_once '../model/model_movwelcome.php';
    $Datas=M_VehiculoDisp($conn);
    $CantidadEnAlquiler=TresVehiculosMaximo($Data);

    function mensaje($CantidadEnAlquiler){
        $CantidadEnAlquiler=intval($CantidadEnAlquiler);
    $TresMaximo=3-$CantidadEnAlquiler;
    $carrito=$_COOKIE['carrito'];
    $carrito=unserialize($carrito);
	 if (count($carrito)==$TresMaximo) {
	 echo '<script language="javascript">alert("Has llegado al maximo de 3 coches");</script>';
	    } 
    }

    function ContarCoches($Datas){
        $Cantidad=count($Datas);
        return $Cantidad;
    }

    function mostrarCesta(){
        $carrito=$_COOKIE['carrito'];
        $carrito=unserialize($carrito);
        
        foreach ($carrito as $orden => $matricula) {
            $Datos=M_DatosCarrito($matricula);
            $numeroVehiculo = $orden + 1;
            echo '<br>';
            echo '<B>Vehiculo: '.$numeroVehiculo.'</B>';
            echo '<br>';
            echo $Datos[0]['matricula'].' '.$Datos[0]['marca'].' '.$Datos[0]['modelo'];
            echo '<br>---------------------------------------------------';
        }
    }

    function VehiDispDesplegable($Datas){

        foreach ($Datas as $key => $value) {
            echo '<option value='.$value['matricula'].'>'.$value['matricula'].'---'.$value['marca'].'---'.$value['modelo'].'</option>';

        }
    }

    if (isset($_POST['agregar'])) {

        $vehiculo=$_POST['vehiculos'];

        $carrito=$_COOKIE['carrito'];
        $carrito=unserialize($carrito);

        if (!in_array($vehiculo,$carrito)) {
            $CantidadEnAlquiler=TresVehiculosMaximo($Data);
            $CantidadEnAlquiler=intval($CantidadEnAlquiler);

            if ($CantidadEnAlquiler<3) {
                $TresMaximo=3-$CantidadEnAlquiler;
                if (count($carrito)<$TresMaximo) {
                array_push($carrito,$vehiculo);

                $carrito=serialize($carrito);
                setcookie('carrito', $carrito , time() + (86400 * 30), "/");
                header('location:./movalquilar.php');
            }
            }
        }
                header('location:./movalquilar.php');
    }

    if (isset($_POST['vaciar'])) {
        $carrito=array();   
        $carrito = serialize($carrito);
        setcookie('carrito', $carrito, time() + (86400 * 30), "/");
        header('location:./movalquilar.php');
    }


    if (isset($_POST['alquilar'])) {
        M_Alquilar($Data);

        $SoN='N';

        $carrito=$_COOKIE['carrito'];
        $carrito=unserialize($carrito);
    
        foreach ($carrito as $orden => $matricula) {
            M_VehiculoSoN($matricula,$SoN);
        }
        $carrito=array();   
        $carrito = serialize($carrito);
        setcookie('carrito', $carrito, time() + (86400 * 30), "/");
        header('location:../view/movwelcome.php');
    }
?>