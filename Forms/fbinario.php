<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Binario</title>
</head>
<body>
<form name="calculadora" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="NumDemal">Operando1</label>
        <input type="text" name="NumDemal"><br><br>

        <input type="submit" name="Enviar" value="Enviar">
        <input type="reset" name="Borrar" value="Borrar"><br><br>
    </form>

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

</body>
</html>