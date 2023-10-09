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
            <th>Valor</th>
            <th>Suma</th>
        </tr>
    <?php
    $vector = [];
    $cont=1;
    $suma=0;
    for($i=0;$i<20;$i++){
        $vector[$i]=$cont;
        $cont=$cont+2;
    }
    for($i=0;$i<20;$i++){
        $suma=$suma + $vector[$i];
        echo "<tr>";
        echo "<td>".$i."</td>";
        echo "<td>".$vector[$i]."</td>";
        echo "<td>".$suma."</td>";
        echo "</tr>";
    }
    ?>
    </table>
</body>
</html>