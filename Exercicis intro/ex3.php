<?php
//Programa que calcula el canvi d'unitats entre graus celsius i graus Fahrenheit.
$message = "";
if (!is_null(filter_input(INPUT_GET,'celToFah'))) { //if button to convert is clicked
    //read data
    $degrees = filter_input(INPUT_GET, "degrees", FILTER_VALIDATE_FLOAT);
    
    if (validate ($degrees)){
        $result = ((float)$degrees * 9/5) + 32;
    } else {
        $message = "invalid numbers";
    }

}

if (!is_null(filter_input(INPUT_GET,'fahToCel'))) { //if button to convert is clicked
    //read data
    $degrees = filter_input(INPUT_GET, "degrees", FILTER_VALIDATE_FLOAT);
    
    if (validate ($degrees)){
        $result = ((float)$degrees -32) * 5/9;
    } else {
        $message = "invalid numbers";
    }
    
    
}

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
    <title>Conversion units</title>
</head>
<body>
    <h1>Conversion units: Celcius vs Farenheit</h1>
    
    <form name="conversion-form" method="get" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <fieldset>
            <legend>Conversion units</legend>
            <div>
                <label for="degrees">Degrees: </label>
                <input type="text" name="degrees" id ="degrees" value="<?php printf("%.2f", $degrees); ?>"></input>
            </div>
            <div>
                <button type="submit" name="celToFah" value="celToFah">Celcius to Farenheit</button>
                <button type="submit" name="fahToCel" value="fahToCel">Farenheit to Celcius</button>
            </div>
            <div>
                <label for="result">Result: </label>
                <input type="text" name="result" id ="result" value="<?php printf("%.2f", $result); ?>" disabled></input>
            </div>
            <p> <?php echo $message;?> </p>
        </fieldset>
    </form>


</body>
</html>