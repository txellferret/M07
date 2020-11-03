<?php
//Programa que determina si un any és o no de traspàs.
$message = "";
if (!is_null(filter_input(INPUT_GET,'submit'))) { //if form submitted
    //read data
    $year =  filter_input(INPUT_GET, "year",  FILTER_VALIDATE_INT);
    
    if (validate ($year)){ // not null nor invalid
        if (isLeapYear((int)$year)) {
            $leapYear = "YES";
        } else  $leapYear = "NO"; 
    } else {
        $message = "invalid numbers";
    }
}

/**
 * checks if a year is a leap year or not
 * @return true if the given year is leap, false otherwise
 */
function isLeapYear (int $x) : bool {
    $leap = false;
    if (date('L', strtotime("$x-01-01"))) {
        $leap = true;
    }
    return $leap;
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
    <title>Leap year</title>
</head>
<body>
    <h1>Leap year</h1>
    <form name="yearLeap-form" method="get" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <div>
            <label for="year">Year: </label>
            <input type="text" name="year" id ="year" value="<?php print($year); ?>"></input>
        </div>
        <div>
            <button type="submit" name="submit" value="submit">Check</button>
        </div>
        <div>
            <label for="leapYear">Is it a leap year? </label>
            <input type="text" name="leapYear" value="<?php print($leapYear); ?>" disabled ></input>
            <p> <?php echo $message;?> </p>
        </div>
    </form>
</body>
</html>