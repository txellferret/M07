<?php
/**
 * compares two sequencies and count number of differences
 * @param seq1 1st sequence to compare
 * @param seq2 2nd sequence to compare
 * @return number of differencies.
 */
function noCoincidences(string $x, string $y) : int{
    $numNoCoin = 0;
    for($i=0;$i<strlen($x);$i++) {
        if ($x[$i] != $y[$i]) {
            $numNoCoin += 1;
        } 

    }
    return $numNoCoin;

}


