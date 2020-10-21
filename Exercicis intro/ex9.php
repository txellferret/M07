<?php
//Programa que, donat un array amb una llista de nombres, 
//calcula els següents paràmetres estadístics: mitjana, mediana, mínim, màxim.
$average;
$median;
$min;
$max;

$divStyleResult='none'; // hide div

if (!is_null(filter_input(INPUT_GET, 'add'))) {
    //data input
    //echo var_dump($_GET);
    $numInput = filter_input(INPUT_GET, "numInput", FILTER_VALIDATE_FLOAT);
    $listPrint = filter_input(INPUT_GET, "listPrint", FILTER_SANITIZE_STRING);

    echo ($listPrint);
    if ($numInput != "") {
        if (validate ($numInput)){
            if (strcmp($listPrint, " ") == "0") {
                $list = array();
            } else {
                $list = parseWordList($listPrint);
            }
        
            array_push($list, $numInput);
            print_r($list);
            $listPrint = printWordList ($list);
        }
    } else $message = "Number not introduced";
    



}

if (!is_null(filter_input(INPUT_GET, 'calculate'))) {
    $listPrint = filter_input(INPUT_GET, "listPrint");
    echo var_dump($_GET);
    if ($listPrint != " " ) {
        $list = parseWordList($listPrint);
        $average = sum($list)/count($list);
        $median = median($list);
        $max = max($list);
        $min = min($list);
        $divStyleResult='block'; //show div
    } else $message = "Number not introduced";
    
}

function validate ($x) : bool {
    $valid = false;
    if ((!is_null($x)) && ($x!== false)) {
        $valid = true;
    }

    return $valid;
}

/**
 * Calculates the sum of a given array of numbers
 * @param array of numbers 
 * @return the result of the sum
 */
function sum (array $numbers): float {
    $total= 0;
    for ($i=0; $i<count($numbers); $i++) {
        $total += $numbers[$i];
    }
    return $total;

}
/**
 * Calculates the median of an array of numbers
 * @param array of numbers
 * @return the result of the median
 */
function median (array $numbers): float {

    //Count how many elements are in the array.
    $num = count($numbers);
    //Determine the middle value of the array.
    $middleVal = floor(($num - 1) / 2);
    //If the size of the array is an odd number,
    //then the middle value is the median.
    if($num % 2) { 
        return $numbers[$middleVal];
    } 
    //If the size of the array is an even number, then we
    //have to get the two middle values and get their
    //average
    else {
        //The $middleVal var will be the low
        //end of the middle
        $lowMid = $numbers[$middleVal];
        $highMid = $numbers[$middleVal + 1];
        //Return the average of the low and high.
        return (($lowMid + $highMid) / 2);
    }
}

/**
 * 
 * @param words: string with all the words seperated by ;
 * @return array of words (string)
 */
function parseWordList(string $words) :array {
    return explode(" ;", $words);
}

/**
 * prints a list in readable format
 */
function printWordList (array $list) :string {
    $value = "";
    if (isset($list)) {
        if (count($list)>0) {
            for ($i=0; $i<count($list)-1; $i++) {
                $value .= sprintf("%s;",$list[$i]);
            }
            $value .= sprintf("%s", $list[count($list)-1]);
        }
    }return $value;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Calculate</h1>
    <form name="calculate-form" method="get" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
    <fieldset>
        <legend>List Numbers Management</legend>
            <div>
                <label for="numInput">Number to add: </label>
                <input type="text" name="numInput" id ="numInput" value="<?php print($numInput); ?>"></input>
            </div>
            <div>
                <button type="submit" name="add" value="add">Add</button>
            </div>
            <div>
                <input type="text" name="listPrint" id ="listPrint" value="<?php echo $listPrint;?> "readonly></input>
                <p> </p>
            </div>
    </fieldset>
    
    <fieldset>
        <legend>Calculate stadistics</legend>
            
            <div>
                <button type="submit" name="calculate" value="calculate">Calculate</button>
            </div>
            <div id="result" style="display: <?= $divStyleResult?>">
                <p><?php echo "Average: ".$average;?></p>
                <p><?php echo "Median: ".$median;?></p>
                <p><?php echo "Minimun: ".$min;?></p>
                <p><?php echo "Maximun: ".$max;?></p>
            
            </div>
            <p><?php echo $message;?></p>
    </fieldset>
    </form>
    
</body>
</html>