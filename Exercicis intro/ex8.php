<?php
//Programa que, donat un array amb una llista de paraules, dóna la posició en què es troba una paraula donada o indica, 
//si és el cas, que no hi és.


$list = array();
$listPrint ="";

if (!is_null(filter_input(INPUT_GET, 'add'))) {
    //data input
    echo var_dump($_GET);
    $word = (string) filter_input(INPUT_GET, "word");
    echo var_dump($word);
    $listPrint = filter_input(INPUT_GET, "listPrint");
    echo var_dump($listPrint);
    if ($word != "") {
        echo var_dump($listPrint);
        if (strcmp($listPrint, " ") == 0) {
            echo "buy";
            $list = array();
        } else {
            $list = parseWordList($listPrint);
        }
        echo $word;
        array_push($list, $word);
        print_r($list);
        echo var_dump($list[0]);
        echo "<br>";
        $listPrint = printWordList ($list);
        echo strlen($listPrint); 
    } else $message = "Word not introduced";
    



}
if (!is_null(filter_input(INPUT_GET, 'find'))) { 
    $listPrint = filter_input(INPUT_GET, "listPrint");
    echo $listPrint;
    $wordToFind = (string) filter_input(INPUT_GET, "wordToFind");

    echo $wordToFind ;
    
    $list = parseWordList($listPrint);
    echo print_r($list);

    $position = findWordPosition($list, $wordToFind);

    echo var_dump($position);

    if ($position === false) {
        $position = "not found";
    }

}


/**
 * 
 * @param words: string with all the words seperated by ;
 * @return array of words (string)
 */
function parseWordList(string $words) :array {
    return explode(";", $words);
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
/**
* Search a word of a list in array
* @param
* @param
* @return false if word not found or index of the word if it is found
*/
function findWordPosition (array $listWords, $word) {
    $index = array_search($word,$listWords);
    return $index;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Found a word</title>
</head>
<body>
    <h1>Found a word</h1>
    <form name="bmi-form" method="get" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
    <fieldset>
        <legend>List Management</legend>
            <div>
                <label for="word">Word to add: </label>
                <input type="text" name="word" id ="word" value="<?php print($word); ?>"></input>
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
        <legend>Find Word</legend>
            <div>
                <label for="wordToFind">Word to find: </label>
                <input type="text" name="wordToFind" id ="wordToFind" value="<?php print($wordToFind); ?>"></input>
            </div>
            <div>
                <button type="submit" name="find" value="find">Find</button>
            </div>
            <div>
                <label for="position">Position: </label>
                <input type="text" name="position" id="position" readonly="readonly" value="<?php echo $position ?>">
            </div>
            <p><?php echo $message;?></p>
    </fieldset>
    </form>
    
</body>
</html>