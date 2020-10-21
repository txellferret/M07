<?php
//Programa que mostra totes les taules de multiplicar (de l'1 al 9).
//Funcio que imprimeix la taula
function printTable(int $x) {
    echo "<table>";
    echo "<tr>";
    echo "<th> Multiplication table of $x</th>";
    echo "</tr>";
        for ($i=1; $i<10; $i++) {
            $z = $i*$x;
            
            echo "<tr>";
            echo "<td>";
            echo "$x * $i = $z";
            echo "</td>";
            echo "</tr>";
        }
    echo"</table>";

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Multiplication tables</title>
</head>
<body>
    <?php
        for($i=1; $i<10; $i++) {
            echo "<div>";
            printTable($i);
            echo "</div>";
        }   
    ?>
    
</body>
</html>