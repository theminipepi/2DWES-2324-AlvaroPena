<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>Indice</th>
            <th>Par</th>
            <th>Impar</th>
        </tr>
    <?php
    $par = [];
    $impar = [];
    $sumapar=0;
    $sumaimpar=0;
    $contImpar=1;
    $contPar=2;
    for($i=0;$i<20;$i++){

        $par[$i]=$contPar;
        $sumapar=$sumapar+$par[$i];
        $contPar=$contPar+2;
        

        $impar[$i]=$contImpar;
        $sumaimpar=$sumaimpar+$impar[$i];
        $contImpar=$contImpar+2;
        
    }
    $mediaPar=$sumapar/($contPar/2);
    $mediaImpar=$sumaimpar/($contImpar/2);
    for($i=0;$i<20;$i++){
        echo "<tr>";
        echo "<td>".$i."</td>";
        echo "<td>".$par[$i]."</td>";
        echo "<td>".$impar[$i]."</td>";
        echo "</tr>";
    }
        echo "<tr>";
        echo "<th>"."Media Par"."</th>";
        echo "<th>"."Media Impar"."</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>".$mediaPar."</td>";
        echo "<td>".$mediaImpar."</td>";
        echo "</tr>";

    ?>
    </table>
</body>
</html>