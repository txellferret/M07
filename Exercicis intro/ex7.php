<?php
//Programa que mostra en format de taula amb dues columnes n, x els valors de la sèrie de Fibonacci fins a un índex n especificat en una variable inicialment.

/**
 * Calculates the fibonacci number of a given one
 * @param a the fibonaci index
 * @return the fibonacci number
 */
function fibonacci_i ($a) {
    if ($a == 0) return 0;
    if ($a == 1) return 1;
    return fibonacci_i($a - 2) + fibonacci_i($a - 1);
}

/**
 * Writes fibonacci serie of a given index
 * @param x index number
 */
function fibonacci (int $x) {
    echo ("<table border=\"1\">");
    for ($i=0; $i<=$x; $i++) {
        echo "<tr>";
        echo "<td>";
        echo $i ."</td>";
        echo "<td>".fibonacci_i($i)."</td> <br>";
        echo "</tr>";
    }
    echo "</table>";
}

if (!is_null(filter_input(INPUT_GET,'calculate'))) { //if button is clicked
    $message = "";
    //read data
    $index = filter_input(INPUT_GET, "index", FILTER_VALIDATE_INT);

    if (validate($index)) {
        //cast to int
        fibonacci ((int)$index); 

    } else  $message = "invalid index";
}

/**
 * validates data format is correct
 * @return true if data format is correct, false otherwise
 */
function validate ($x) : bool {
    $valid = false;
    if ((!is_null($x)) && ($x!== false)) {
        $valid = true;
    }
    return $valid;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fibonacci serie</title>
</head>
<body>
    <form name="fibonacci-form" method="get" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <fieldset>
        <legend>Fibonacci serie</legend>
            <div>
                <label for="index">Until which index to calculate fibonacci serie: </label>
                <input type="text" name="index" id ="index" value="<?php  print($index); ?>"></input>
            </div>
            <div>
                <button type="submit" name="calculate" value="calculate">Calculate</button>
            </div>
            
            <p> <?php echo $message;?> </p>
        </fieldset>
    </form>
</body>
</html>
