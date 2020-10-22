<?php
//Programa que donada la seqüència d'aminoàcids d'una proteïna, 
//mostra una seqüència de nucleòtids que la codifiqui.

include 'fn-sequences.php';
$divStyleRNA='none'; // hide div

define("AA", array("A", "R", "N", "D", "C", "Q", "E", "G", "H", "I", "L", "K", "M", "F", "P", "S", "T", "W", "Y", "V")); 
$nucleotidsRNAAA = array ("F" =>"UUU/UUC","L" =>"UUA/UUG/CU*", "S" =>"UC*",
"Y" => "UAU/UAC", "C" => "UGU/UGC", "W" => "UGG", 
"P" => "CC*", "H" =>"CAU/CAC", "Q" => "CAA/CAG", "R" =>"CG*/AGA/AGG" , 
"I" => "AUU/AUC/AUA", "M" =>"AUG" , "T" =>"AC*" , "N" =>"AAU/AAC","K" => "AAA/AAG", 
"S" =>"AGU/AGC", "V" =>"GU*", "A" => "GC*", "D" =>"GAU/GAC",
"E" => "GAA/GAG", "G" =>"GG*");

if (!is_null(filter_input(INPUT_GET,'analize'))) { //if button is clicked

    $inputSeq = strtoupper(filter_input(INPUT_GET, "seq"));
    if (checkValidSequence($inputSeq, AA)) {
        echo "valid";
        $aminoacids = splitsSeqRNA ($inputSeq,1);
        print_r($aminoacids);
        $seqRNA = convertToNucleotids ($aminoacids);
    
    }else $errors = "Invalid sequence";

    $divStyleRNA='block'; //show div


}
function convertToNucleotids (array $seq) :string {
    $chainNucleotids = "";
    global $nucleotidsRNAAA;
    for ($i=0; $i < count($seq); $i++) { 
        $aa = $seq[$i];
        
        if(array_key_exists($aa, $nucleotidsRNAAA)){
            $chainNucleotids .= $nucleotidsRNAAA[$codon]; 
        
       
        } 
    }
    return $chainNucleotids;
}

/**
 * Validates a sequences
 * @param seq to validate
 * @param validCahrs acceptable chars on the sequence
 * @return true if sequence is valid, false otherwise
 */
function checkValidSequence (string $seq, array $validChars) : bool {
    $valid = true; 
    for ($i=0; $i<strlen($seq); $i++) {
        if (!in_array(strtoupper($seq[$i]), $validChars)) {
            $valid = false; 
            break;
        }  
    }
    return $valid;
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
                <label for="seq">Sequence </label>
                <input type="text" name="seqAA" id ="seqAA" value="<?php  print($inputSeq); ?>"></input>
            </div>

            <div>
                <button type="submit" name="analize" value="analize">Analize</button>
            </div>
            <div id="dna" style="display: <?= $divStyleRNA?>">
                <p> <?php echo $seqRNA?> </p>
                <p> <?php echo "Errors: ". $errors?> </p>
            </div>
            
    
</body>
</html>
