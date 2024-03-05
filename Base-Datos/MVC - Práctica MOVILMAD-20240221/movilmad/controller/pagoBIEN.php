<?php
		include_once '../controller/controller_functions.php';
        include_once '../model/model_movdevolver.php';        
        include_once '../db/conexion.php';
		C_UserCookie();
?>
<html> 
<body> 
<?php
	include './apiRedsys.php';

	$miObj = new RedsysAPI;

		if (!empty( $_GET ) ) {
            try {
                global $conn;
                $conn->beginTransaction();
            
                $version = $_GET["Ds_SignatureVersion"];
                $datos = $_GET["Ds_MerchantParameters"];
                $signatureRecibida = $_GET["Ds_Signature"];
                    
                $decodec = $miObj->decodeMerchantParameters($datos);
                $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
                $firma = $miObj->createMerchantSignatureNotif($kc,$datos);
            
                if ($firma === $signatureRecibida){
                    session_start();
                    $matricula=$_SESSION['matricula'];
                    $preciototal=$_SESSION['preciototal'];

                    date_default_timezone_set('Europe/Madrid');
                    $ahora=date('Y-m-d H:i:s');
                    insertarPago($matricula,$preciototal,$ahora);
                    session_destroy();
                    echo "Pago Realizado<br>";
                }
                $conn->commit();
                
            } catch (Exception $e) {
                $conn->rollBack();
                echo "Transaction failed: " . $e->getMessage();
            }
            $conn = null;
		}
		else{
			die("No se recibió respuesta");
		}

?>
</body> 
</html>

