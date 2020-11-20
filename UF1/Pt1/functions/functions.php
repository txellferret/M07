<?php
/**
 * Validates a field if it is not empty or if is not false according to the filter_inputs
 * @param field to validate
 * @return true if it is valid, false otherwise
 */
function validateField ($field) :bool {
    $valid = false;
    if ($field !=="" && $field !== false){
        $valid = true;
    }
    return $valid;

}
/**
 * Checks if a given username already exits in a data file
 * @param username to check
 * @param filepath to search
 * @return true if it is unique, false otherwise
 */
function checkUniqueUsername ($username, $filePath) : bool {
    $unique = true;
    $handle = fopen($filePath,'r');
    //posem 0 per omitir caracters de fi de linea
    while (($row = fgetcsv($handle,0,";")) !== FALSE) {
        $numero = count($row);
        if ($row[0] === $username) {
            $unique = false;
        break;
        }

    }
    
    fclose($handle);
    return $unique;
}

/**
 * 
 */
function selectCategories($categories, $categoryToModify) {
    for ($i=0; $i < count($categories); $i++) { 
        if (trim($categoryToModify) == trim($categories[$i])) {
            echo "<option value=\"$categories[$i]\"selected>$categories[$i]</option>";
        }
        else {
            echo "<option value=\"$categories[$i]\">$categories[$i]</option>";
        }
        
    }
}
/**
 * Lists all elements
 * @param array of lines to list
 */
function listInput(array $lines, $type) {
    for ($i=0; $i < count($lines); $i++) { 
        $line = explode(";", $lines[$i]);
        echo "<tr>";
        
        echo "<td><a href=\"../pages/modify$type.php?id=$line[0]\">$line[0]</a></td>";
        for ($j=1; $j < count($line); $j++) { 
            echo "<td>".$line[$j]."</td>";
        }
        echo "</tr>";   
    } 
}

/**
 * Find the interested line in a doc to modify
 * @param filePath the file where to search
 * @param key which identifies the row
 * @return null if error occurred, an array of the interested line otherwise
 */
function findLine ($filePath, $key)  {
    $result = null;

    $lines = file($filePath);
    for ($i=0; $i < count($lines); $i++) { 
        $line = explode(";", $lines[$i]);

        if ($line[0] == $key) {
            $result = $line;
        break;
        }
    }
    return $result;
}


/**
 * Edits the line with new fields and put it into the global array
 * @param newline to change of the array of lines
 * @return true if successfully changed, false otherwise
 */
function editFile (array $newLine, $allDoc) : bool {
    global $allDoc;
    $changed = false;
    if (!empty($newLine)) {

        for ($i=0; $i < count($allDoc); $i++) { 
            $line = explode(";",$allDoc[$i]);
            print_r($line);
            if($line[0] == $newLine[0]){
                //transformem line en un string
                $strinNewLine = implode(";", $newLine);
                $allDoc[$i] = $strinNewLine.PHP_EOL;
            break;
            }
        }
        $changed = true;
    }
    return $changed;

}
/**
 * Wrties the new changed line to the file
 * @param file to write
 * @return true if successfully done, false otherwise.
 */
function saveChangesToFile ($filePath, array $allDoc) :bool {
    $done =false;
    $h = fopen($filePath, "w");
    if ($h !==false ) {
        // Guardar los cambios en el archivo:
        for ($i=0; $i < count($allDoc); $i++) { 
            trim($allDoc[$i]);
            fwrite($h, $allDoc[$i]);
        }
        $done = true;
    }
    fclose($h);

    return $done;
}

