<?php
namespace proven\sequencies {
    /**
     * Description of Sequence
     * @author ProvenSoft
     */
    class Sequence {
        public $DNA_NUCLEOTIDES = 'acgt';
        public $RNA_NUCLEOTIDES = 'acgu';
        public $DNA_RNA_NUCLEOTIDES = 'acgtu';
        public $AMINOACIDS = 'ARNDCQEGHILKMFPSTWYV';
        public $DNA_NUCLEOTIDES_COMPL = array(
            'a' => 't',
            'c' => 'g',
            'g' => 'c',
            't' => 'a'
        );

        public function __construct() {

        }

        /**
        * generate a sequence of accepted values with the given length.
        * @author ProvenSoft
        * @version 2016/September
        * @param string $acceptedValues string with accepted values
        * @param int $length length of the requested sequence
        * @return string: sequence of accepted values and the given length or empty string in case of error.
        */
        public function generateRandomSequence( string $acceptedValues, int $length ): string {
           $seq = "";
           for ($i=0; $i<$length; $i++) {
             $randomNumber = \mt_rand(0, strlen($acceptedValues)-1);
             $randomChar = $acceptedValues["$randomNumber"];
             $seq .= $randomChar;
           }
           return $seq;
        }

        /**
        * count ocurrencies of accepted values in data string.
        * @author ProvenSoft
        * @version 2016/09/29
        * @param string $data data to parse
        * @param string $acceptedValues string with accepted values
        * @return associative array with a counter for each accepted value and another one for the rejected ones.
        */
        public function countOccurrencies( string $data, string $acceptedValues ): array {
          //create an array of counters
           $countArray = array();
          //initialitze counters (one for each accepted value and one more for rejected values)
           for ($index=0; $index<\strlen($acceptedValues); $index++) {
             $countArray["$acceptedValues[$index]"] = 0;
           }
           $countArray['rejected'] = 0;
           //parse data and count occurrencies
           for ($index=0; $index<\strlen($data); $index++) {
             //check if letter is an accepted value
             $pos = \stripos( $acceptedValues, $data[$index] );
             if ($pos === false) {  //if not, increment rejected counter
               $countArray['rejected']++;
             } else {  //if so, increment the corresponding counter
               $countArray[$acceptedValues[$pos]]++;
             }
           }
           return $countArray;
        }

    }  //end class.

}  //end namespace.