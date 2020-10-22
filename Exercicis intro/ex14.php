<?php
//Programa que donada una seqüència de nucleòtids, 
//indiqui la seqüència d'aminoàcids en què s'expressa (amb lletra i nom).

include 'fn-sequences.php';
$divStyleAA='none'; // hide div
define("RNACHARS", array("A", "U", "G", "C"));
$errors = "0";

$nameAA = array ("F" => "Phenylalanine", "L" => "Leucine", "I" => "Isoleucine", 
"M" => "Methionine", "V" => "Valine", "S" => "Serine", "P" => "Proline", "T" => "Threonine", 
"A" => "Alanine", "Y" => "Tyrosine", "H" => "Histidine", "Q" => "Glutamine", "N" => "Aspargine", 
"K" => "Lysine", "D" => "Aspartic acid", "E" => "Glutamic acid", "C" => "Cysteine", "W" => "Tryptophan", 
"R" => "Arginine", "G" => "Glycine");

$nucleotidsAA = array ("UUU" => "F","UUC" => "F","UUA" => "L", "UUG" => "L", "UC*" => "S",
"UAU" => "Y", "UAC" => "Y", "UGU" => "C", "UGC" => "C", "UGG" => "W", 
"CU*" => "L", "CC*" => "P", "CAU" => "H", "CAC" => "H", "CAA" => "Q", "CAG" => "Q", "CG*" => "R", 
"AUU" => "I", "AUC" => "I", "AUA" => "I", "AUG" => "M", "AC" => "T", "AAU" => "N", "AAC" => "N", "AAA" => "K","AAG" => "K", 
"AGU" => "S", "AGC" => "S", "AGA" => "R", "AGG" => "R", "GU*" => "V","GC*" => "A", "GAU" => "D","GAC" => "D",
"GAA" => "E","GAG" => "E", "GG*" => "G");


if (!is_null(filter_input(INPUT_GET,'analize'))) { //if button is clicked
    $inputSeq = strtoupper(filter_input(INPUT_GET, "seq"));
    
    if (checkValidSequence($inputSeq, RNACHARS)) {
        $arrayCodons = splitsSeqRNA ($inputSeq,3);
        $AA = convertToAA ($arrayCodons);

        //converts to their AA names
        $AAname = convertNameAA($AA);


    } else $errors = "Invalid sequence";

    $divStyleAA='block'; //show div
}

/**
 * Converts a given aminoacid symbol string chain to their complete name
 * @param string of aminoacids symbols
 * @return the string with the complete name of each AA
 */
function convertNameAA (string $aminoacids) :string{
    $arrayAA = splitsSeqRNA ($aminoacids,1);
    $chainAAname = "";
    global $nameAA;
    for ($i=0; $i < count($arrayAA); $i++) { 
        $name = $arrayAA[$i];
        
        if(array_key_exists($name, $nameAA)){
            $chainAAname .= $nameAA[$name]." "; 
        }
    }
    return $chainAAname;
}

/**
 * Converts a given array of nucleotids to their correspondig AAs
 * @param array of codons
 * @return the sequence of AAs
 */
function convertToAA (array $seq) :string {
    $chainAA = "";
    global $nucleotidsAA;
    for ($i=0; $i < count($seq); $i++) { 
        $codon = $seq[$i];
        
        if(array_key_exists($codon, $nucleotidsAA)){
            $chainAA .= $nucleotidsAA[$codon]; 
        
        //AA codificants amb dos nucleotids
        } elseif (array_key_exists(substr($codon, 0, 2)."*",$nucleotidsAA )) {
            $chainAA .= $nucleotidsAA[substr($codon, 0, 2)."*"];
        } 
    }
    return $chainAA;
}

/**
 * Splits a string into an array
 * @param string to split
 * @return the array of strings splitted
 */
function splitsSeqRNA (string $seq, int $j) : array {

    $codons = array();
    for ($i=0; $i <= strlen($seq)-$j; $i +=$j) { 
        $prova = substr($seq, $i, $j);
        array_push($codons, $prova);
        
    }
    return $codons;
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
    <form name="analize-form" method="get" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <fieldset>
        <legend>Analize sequence</legend>
            <div>
                <label for="seq"><b>RNA</b> sequence </label>
                <input type="text" name="seq" id ="seq" value="<?php  print($inputSeq); ?>"></input>
            </div>
            <div>
                <button type="submit" name="analize" value="analize">Analize</button>
            </div>
            <div id="aa" style="display: <?= $divStyleAA?>">
                <p><?php echo "Aminoacid sequence: ".$AA?> </p>
                <p><?php echo "Aminoacid sequence name: ".$AAname?> </p>
                <p> <?php echo "Errors: " . $errors?> </p>
            </div>
        </fieldset>
    </form>
</body>
</html>
