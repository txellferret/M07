<?php
//Es desa en fitxer informació sobre paísos (nom, capital, extensió, població, etc). 
//Amb un selector se selecciona un país i es mostra la seva informació en un formulari. 
//El formulari permetrà enviar canvis en les dades i desar-les al fitxer.

$divStyleResult='none'; // hide div
$allDoc;
$filePath = "files/countries.csv";

$selectorCountries = selectCountries(getCountriesNames($filePath));

if (!is_null(filter_input(INPUT_GET, "viewInfo"))) {

    $selectedCountry = filter_input(INPUT_GET, 'countries');
    $info = showInfo($selectedCountry);
    $divStyleResult='BLOCK'; // show div
}

if (!is_null(filter_input(INPUT_GET, "edit"))) {
    //variables
    $country = filter_input(INPUT_GET, 'country');
    $capital = filter_input(INPUT_GET, 'capital');
    $newExtension = filter_input(INPUT_GET, 'extension', FILTER_VALIDATE_INT);
    $newPopulation = filter_input(INPUT_GET, 'population', FILTER_VALIDATE_INT);

    $newCountry = array ($country, $capital,$newExtension, $newPopulation);
    $allDoc = readOurFile($filePath);

    if ($newExtension !== false && $newPopulation !== false) {
        if ($result = editCountryOnGlobalArray($newCountry)) {
            if ($r = saveChangesToFile($filePath)) {
                $message = "Changes successfully changed";
            }
        }
    } else $message = "Bad data";

    
    $divStyleResult='BLOCK'; // show div
}



/**
 * Read the file and puts each line into an array
 * @param file to read
 * @return an array with each line
 */
function readOurFile ($filePath) : array {
    $allDoc = file($filePath);
    return $allDoc;

}
/**
 * Gets countries names and put them into array
 * @param file to read
 * @return an array of countries names
 */
function getCountriesNames ($filePath) : array {
    $listCountriesNames = array();
    $handle = fopen("files/countries.csv",'r');
    //Loop through the CSV rows.
    while (($row = fgetcsv($handle,",")) !== FALSE) {
        //estem a una fila. Recorrem la unica col que ens interesa
        array_push($listCountriesNames, $row[0]); 
    }
    fclose($handle);

    return $listCountriesNames;

}



/**
 * Creates a selector html
 * @param array of element to put in the selector
 */
function selectCountries (array $list)  {
    $result = "";
    for ($i=0; $i < count($list); $i++) { 
        $result .="<option value=\"$list[$i]\">$list[$i]</option><br>";
        
    }
    return $result;
}

/**
 * Gets the information of a given country
 * @param the country name to read
 * @return an array with all fields of the country
 */
function showInfo (string $countryName) :array {
    $info = array();
    
    $handle = fopen("files/countries.csv",'r');
    while (($row = fgetcsv($handle,",")) !== FALSE) {
        if ($row[0] == $countryName) {
            //recorrem la fila per totes les col
            $num = count ($row);
            for ($i=0; $i < $num ; $i++) { 
                array_push($info, $row[$i]); 
            }
           
        break;
        }
    }fclose($handle);
    return $info;
}
/**
 * Edits the line of a country with new fields and put it into the global array
 * @param newline to change of the array of lines
 * @return true if successfully changed, false otherwise
 */
function editCountryOnGlobalArray (array $newLine) : bool {
    global $allDoc;
    print_r ($allDoc); 
    $changed = false;
    if (!empty($newLine)) {
        for ($i=0; $i < count($allDoc); $i++) { 
            //volem 4 elements, 4 col
            $line = explode(",",$allDoc[$i],4);

            if($line[0] == $newLine[0]){
                //transformem line en un string
                $strinNewLine = implode(",", $newLine);
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
function saveChangesToFile ($filePath) :bool {
    $done =false;
    global $allDoc;
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


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ex4</title>
</head>
<body>
    <h2>Country information</h2>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="form-countries" method = "get">
    <label for="cars">Choose a country:</label>
        <select name="countries" >
            <?php echo $selectorCountries?>
        </select>

        <button type = "submit" name = "viewInfo">View information</button>
        <br>
        <br>
        <div style="display: <?= $divStyleResult?>">
            <label for="country">Country:</label>
            <input type="text" id="country" name="country" readonly value="<?php echo $info[0]?>"><br>
            <label for="capital">Capital:</label>
            <input type="text" id="capital" name="capital" readonly value="<?php echo $info[1]?>"><br>
            <label for="extension">Extension:</label>
            <input type="text" id="extension" name="extension" value="<?php echo $info[2]?>"><br>
            <label for="population">Population:</label>
            <input type="text" id="population" name="population" value="<?php echo $info[3]?>"><br>

            <button type = "submit" name ="edit">Save changes</button>

            <p><?php echo $message?></p>
        </div>
    
    </form>
    
</body>
</html>
