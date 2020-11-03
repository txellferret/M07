<?php
//Programa que obre un fitxer amb text(seleccionat per l'usuari d'entre els disponibles) i 
//indica en una taula el nombre de paraules que comencen per cada lletra.
$directory = "files";
$listFiles = array();
$files = "";
$errors="";
$countersLetters = array (
    'a' => 0,
    'b' => 0,
    'c' => 0,
    'd' => 0,
    'e' => 0,
    'f' => 0
);

if ($handle = opendir($directory)) {
    //iterate in the directory
    while (($entrada = readdir($handle))!== false) {
        if(!is_dir($entrada)) {
            array_push($listFiles, $entrada);
        }
    }
    closedir($handle);
} else exit("Error ocurred");

$files = printArray ($listFiles);
    

if (!is_null(filter_input(INPUT_GET, "send"))) {
    $chosedFile = filter_input(INPUT_GET, "choosed");
    if (!is_null($chosedFile)) {
        countWord ($chosedFile);
    } else $errors="Select a file";
    

}
    
/**
 * Prints an array in a readeable format
 * @param array to print
 * @return a string with all elements
 */
function printArray ($arrayToPrint) : string {
    $list ="";
    for ($i=0; $i < count($arrayToPrint); $i++) { 
        $list .="<label><input type=\"radio\" value=".$arrayToPrint[$i]." name=\"choosed\">".$arrayToPrint[$i]."</label><br>";
        //$list .= "<li>".$arrayToPrint[$i]."</li>";
    }
    return $list;
}


/**
 * Counts the number of words starting with the letter in array
 * @param the file to open and count words
 */
function countWord ($fileName) {
    global $directory;
    global $countersLetters;
    $content = file_get_contents($directory."/".$fileName);
    $words = explode(" ", $content);

    for ($i=0; $i < count($words); $i++) { 
        switch (substr(trim(strtoupper($words[$i])),0,1)){
            case 'A':
                $countersLetters['a'] += 1;
            break;
            case 'B':
                $countersLetters['t'] += 1;
            break;
            case 'C':
                $countersLetters['g'] += 1;
            break;
            case 'D':
                $countersLetters['c'] += 1;
            break;
            case 'E':
                $countersLetters['c'] += 1;
            break;
            case 'F':
                $countersLetters['c'] += 1;
            break;
        }
    }


}


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex2</title>
</head>
<body>
    <h1>Count words!</h1>
    <form action= "<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="form-count" method = "get">
        <label for="directory">Current directory:</label>
        <input type="text" name="directory" size="50" value="<?php echo realpath($directory) ?>" readonly>
        <br>
        <p>List of files. Choose a file:</p>

        
        <p><?php echo $files ?></p>
        <button type ="submit" name="send">Send</button>

        <p><?php echo $errors ?></p>
    
    </form>
    <div id="result">
        <table>
            <tr>
                <th>A</th>
                <th>B</th>
                <th>C</th>
                <th>D</th>
                <th>E</th>
                <th>F</th>
            </tr>
            <tr>
                <td><?php echo $countersLetters[a]; ?></td>
                <td><?php echo $countersLetters[b]; ?></td>
                <td><?php echo $countersLetters[c]; ?></td>
                <td><?php echo $countersLetters[d]; ?></td>
                <td><?php echo $countersLetters[e]; ?></td>
                <td><?php echo $countersLetters[f]; ?></td>
            </tr>
        
        
        
        </table>
    
    
    </div>
</body>
</html>