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
            <th>Binario</th>
            <th>Octal</th>
            <th>Invertido</th>
        </tr>
    <?php
    $binario = [];
    $binarioInverso=[];
    $octal = [];
    for($i=0;$i<20;$i++){
        $binario[$i] = decbin($i);
        $octal[$i] = decoct($i);
        $binarioInverso[$i]=strrev(decbin($i));
    }
    for($i=0;$i<20;$i++){
        echo "<tr>";
        echo "<td>".$i."</td>";
        echo "<td>".$binario[$i]."</td>";
        echo "<td>".$octal[$i]."</td>";
        echo "<td>".$binarioInverso[$i]."</td>";
        echo "</tr>";
    }
    ?>
    </table>
</body>
</html>