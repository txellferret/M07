<?php

define("DNACHARS", array("A", "T", "G", "C"));
define("RNACHARS", array("A", "U", "G", "C"));
define("AA", array("A", "R", "N", "D", "C", "Q", "E", "G", "H", "I", "L", "K", "M", "F", "P", "S", "T", "W", "Y", "V")); 

$nucleotidsRNAAA = array ("F" =>"UUU/UUC","L" =>"UUA/UUG/CU*", "S" =>"UC*",
"Y" => "UAU/UAC", "C" => "UGU/UGC", "W" => "UGG", 
"P" => "CC*", "H" =>"CAU/CAC", "Q" => "CAA/CAG", "R" =>"CG*/AGA/AGG" , 
"I" => "AUU/AUC/AUA", "M" =>"AUG" , "T" =>"AC*" , "N" =>"AAU/AAC","K" => "AAA/AAG", 
"S" =>"AGU/AGC", "V" =>"GU*", "A" => "GC*", "D" =>"GAU/GAC",
"E" => "GAA/GAG", "G" =>"GG*");

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
 * Converts an AA chain to their possible nucleotids
 * @param sequence of AA
 * @return string of their corresponding nucleotids
 */
function convertToNucleotids (array $seq) :string {
    $chainNucleotids = "";
    global $nucleotidsRNAAA;
    for ($i=0; $i < count($seq); $i++) { 
        $aa = $seq[$i];
        
        if(array_key_exists($aa, $nucleotidsRNAAA)){
            $chainNucleotids .= $nucleotidsRNAAA[$aa].";"; 
        } 
    }
    return $chainNucleotids;
}

