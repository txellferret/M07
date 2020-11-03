<?php
//Programa que calcula l'edat d'una persona (en anys, mesos i dies) a partir de la data de naixement.

if (!is_null(filter_input(INPUT_GET,'calculate'))) { //if button is clicked
    $message = "";
    //read data
    $birthDate = filter_input(INPUT_GET, "birthDate");

    if (validateDate($birthDate)) {
        //cast to date object
        $date = date_create($birthDate);
        $message = howOldIs ($date);
    } else  $message = "invalid date";
}

/**
 * validates a date with format YYYY-MM-DD or YYYY/MM/DD
 * @return true if format is correct, false otherwise
 */
function validateDate($date) : bool{
    $validDate = false;

    $test_arr  = explode('-', $date);
    if (count($test_arr) == 3) {
        if (checkdate($test_arr[1], $test_arr[2], $test_arr[0])) { 
            $validDate = true;
        } 
    } else {
        $test_arr  = explode('/', $date);
        if (count($test_arr) == 3) {
            if (checkdate($test_arr[1], $test_arr[2], $test_arr[0])) { 
                $validDate = true;
            } 
        }
    }
    return $validDate;
} 

/**
 * calculates the age given a birthday date
 * @return how old is it
 */
function howOldIs ($birhday) :string{
    $now = date_create();
    $dateInt = date_diff( $birhday,$now);
    $message = (string) $dateInt->format("Years: %y, Month: %m, days: %d.");
    return $message;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>How old are you?</h1>
    <form name="old-form" method="get" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <fieldset>
        <legend>How old are you</legend>
            <div>
                <label for="birthDate">Birthday date (YYYY-MM-DD or YYYY/MM/DD): </label>
                <input type="text" name="birthDate" id ="birthDate" value="<?php print($birthDate); ?>"></input>
            </div>
            <div>
                <button type="submit" name="calculate" value="calculate">Calculate your age</button>
            </div>
            <p> <?php echo $message;?> </p>
        </fieldset>
    </form>
</body>
</html>



