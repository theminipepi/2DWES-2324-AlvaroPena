<?php
if($_SERVER['REQUEST_METHOD']=='POST'){

    $Decimal=$_POST['NumDemal'];
    $Binario=decbin($Decimal);

    echo "<label for=NumDemal>Numero Decimal </label>";
    echo "<input type=text name=NumDemal value='$Binario'><br><br>";
    echo "<label for=NumBinario>Numero Binario </label>";
    echo "<input type=text name=NumBinario value='$Binario'>";

}
?>