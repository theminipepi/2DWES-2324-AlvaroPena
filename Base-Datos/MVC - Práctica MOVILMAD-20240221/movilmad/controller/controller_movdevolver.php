<?php
include_once '../model/model_movdevolver.php';
include_once '../model/model_movalquilar.php';
$Vehiculos=M_VehiculosAlquilados($Data);

function pasarela($preciototal,$orderNumber){
    // Se incluye la librería
    include './apiRedsys.php';
    // Se crea Objeto
    $miObj = new RedsysAPI;
    // Valores de entrada que no hemos cambiado para ningún ejemplo
    $fuc="999008881";
    $terminal="1";
    $moneda="978";
    $trans="0";
    $urlOK="http://localhost/MVC%20-%20Pr%c3%a1ctica%20MOVILMAD-20240221/movilmad/controller/pagoBIEN.php";
    $urlKO="http://localhost/MVC%20-%20Pr%c3%a1ctica%20MOVILMAD-20240221/movilmad/controller/pagoMAL.php";

    // Se Rellenan los campos
    $miObj->setParameter("DS_MERCHANT_AMOUNT",$preciototal);
    $miObj->setParameter("DS_MERCHANT_ORDER",$orderNumber);
    $miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$fuc);
    $miObj->setParameter("DS_MERCHANT_CURRENCY",$moneda);
    $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$trans);
    $miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);
    $miObj->setParameter("DS_MERCHANT_MERCHANTURL",$urlOK);
    $miObj->setParameter("DS_MERCHANT_URLOK",$urlOK);
    $miObj->setParameter("DS_MERCHANT_URLKO",$urlKO);

    //Datos de configuración
    $version="HMAC_SHA256_V1";
    $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';//Clave recuperada de CANALES
    // Se generan los parámetros de la petición
    $params = $miObj->createMerchantParameters();
    $signature = $miObj->createMerchantSignature($kc);
    echo '<form id="frm" name="frm" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST" target="_blank">';
    echo '<input type="text" name="Ds_SignatureVersion" value="'.$version.'" hidden/><br>';
    echo '<input type="text" name="Ds_MerchantParameters" value="'.$params.'" hidden/><br>';
    echo '<input type="text" name="Ds_Signature" value="'.$signature.'" hidden/><br>';
    echo '<input type="submit" value="Acceder al Pago" name="devolver" class="btn btn-warning disabled">';
    echo '</form>';   
}

function AlquiladosDesplegable($Vehiculos){
        foreach ($Vehiculos as $key => $value) {
            echo '<option value='.$value['matricula'].'>'.$value['matricula'].'---'.$value['fecha_alquiler'].'</option>';
        }
}

function convertirPrecio($preciototal) {
    $precioCentavos = $preciototal * 100;
    $precioString = str_replace('.', '', strval($precioCentavos));
    if (strlen($precioString) == 2) {
        $precioString .= '00'; // Ejemplo: 24.4 -> 2440
    } elseif (strlen($precioString) == 3) {
        $precioString .= '0'; // Ejemplo: 23.45 -> 2345
    } elseif (strlen($precioString) < 2) {
        $precioString = '00'; // Para casos como 0.1
    }
    return $precioString;
}

if (isset($_POST['devolver'])) {
    session_start();
    $matricula=$_POST['vehiculos'];
    $_SESSION['matricula'] = $matricula;
    

    $SoN='S';
    date_default_timezone_set('Europe/Madrid');
    $hoy=date('Y-m-d H:i:s');
    M_VehiculoSoN($matricula,$SoN);

    //sacamos el precio base
    $preciobase=M_PrecioBase($matricula);

    //sacamos la fecha del alquiler
    $fechainicio=M_FechaAlquiler($matricula,$Data);

    //calculamos los minutos de diferencia
    $diferencia=M_Diferencia($hoy,$fechainicio,$Data);

    $preciototal=$diferencia*$preciobase;

    $preciototal=convertirPrecio($preciototal);
    if ($preciototal>0) {
        $_SESSION['preciototal'] = $preciototal;
        $orderNumber=rand();
        pasarela($preciototal,$orderNumber);
    }else{
        echo 'El importe es de 0€';
    }
}
?>