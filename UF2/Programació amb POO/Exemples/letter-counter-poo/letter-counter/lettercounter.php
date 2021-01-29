<?php
/**
* compute number of occurrencies of accepted values in a sequence.
*/
//include libraries of functions.
include 'php-fn/debug.php';
include 'php-fn/sequence.fn.php';
//use library namespace.
use proven\sequencies as sequencies;
//define input data
$acceptedChars = sequencies\DNA_RNA_NUCLEOTIDES;
$sequence = sequencies\generateRandomSequence( $acceptedChars, 20 );
//invoke method countOccurrencies() to create and calculate counters
$validChars = sequencies\DNA_NUCLEOTIDES;
$occurrencies = sequencies\countOccurrencies( $sequence, $validChars );
//print results
proven\debug\print_r ($occurrencies);
proven\debug\var_dump ($occurrencies);
