<?php
//Programa que recompta el nombre de vegades que apareix un nucleòtid en una seqüència i recompta també el 
//total de valors no vàlids. 
//Utilitza una funció per fer el recompte, la qual retorna els resultat en un array associatiu.

/**
* compute number of occurrencies of accepted values in a sequence.
*/
//include libraries of functions.
include 'php-fn/debug.php';
require 'php-fn/sequence.fn.php';
//use library namespace.
use proven\sequencies as sequencies; //espai de nom general que es diu proven. Amb use generem un alias (sequencies) que equival a proven\sequencies
//define input data
$acceptedChars = sequencies\DNA_RNA_NUCLEOTIDES; //accepto a al sequencia
$sequence = sequencies\generateRandomSequence( $acceptedChars, 20 );
echo "Sequence: $sequence";
//invoke method countOccurrencies() to create and calculate counters
$validChars = sequencies\DNA_NUCLEOTIDES; //els que compto com a valids
$occurrencies = sequencies\countOccurrencies( $sequence, $validChars );
//print results
proven\debug\print_r ($occurrencies); //fem una versio de la funcio de la llibreria php print_r per tal que surti en un format mes maco.
proven\debug\var_dump ($occurrencies);
