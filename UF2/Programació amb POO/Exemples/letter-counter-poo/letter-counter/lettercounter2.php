<?php
/**
* compute number of occurrencies of accepted values in a sequence.
*/
//include libraries of functions.
include 'php-fn/debug.php';
require 'php-classes/sequence.class.php';
//use library namespace.
use proven\sequencies\Sequence as Sequence;
$seqService = new Sequence();
//define input data
$acceptedChars = $seqService->DNA_RNA_NUCLEOTIDES;
$sequence = $seqService->generateRandomSequence( $acceptedChars, 20 );
//invoke method countOccurrencies() to create and calculate counters
$validChars = $seqService->DNA_NUCLEOTIDES;
$occurrencies = $seqService->countOccurrencies( $sequence, $validChars );
//print results
proven\debug\print_r ($occurrencies);
proven\debug\var_dump ($occurrencies);
