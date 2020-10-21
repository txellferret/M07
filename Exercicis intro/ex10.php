<?php
//Programa que compara dues sequencies i informa del nombre de posicions no coincidents.
if (!is_null(filter_input(INPUT_GET,'generate'))) { //if button is clicked
    $firstSequence = generateRandomSequence(10, array("A", "T", "G", "C"));
    $secondSequence = generateRandomSequence(10, array("A", "T", "G", "C"));
    $noCoind = nonCoinPositions($firstSequence, $secondSequence);
}
/**
 * Generates a random sequence
 * @param long the length of the sequence
 * @param validChars to the sequence
 * @return the generated sequence
 */
function generateRandomSequence (int $long, array $validChars) :string {
    $generatedSeguence = "";
    for ($i=0; $i<$long; $i++) {
        $random = (int) rand(0, count($validChars)-1);
        $generatedSeguence .= $validChars[$random];
    }
    return $generatedSeguence;
}


/**
 * Calculates the number of non coincidences positions
 * @param seq1 first sequence to check
 * @param seq2 second sequence to check
 * @return the number of non coincidences positions
 */
function nonCoinPositions (string $seq1, string $seq2) : int {
    $nonCoin = 0;
    for ($i=0; $i<strlen($seq1); $i++) {
        if ($seq1[$i] != $seq2[$i]) {
            $nonCoin += 1;
        } 
    }
    return $nonCoin;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Complementary DNA sequences</title>
</head>
<body>
    <form name="sequenceCoin-form" method="get" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <fieldset>
        <legend>Number of no coincidences positions</legend>
            <div>
                <label for="seq1">First sequence </label>
                <input type="text" name="seq1" id ="seq1" value="<?php  print($firstSequence); ?>" disabled></input>
                <label for="seq1">Second sequence </label>
                <input type="text" name="seq2" id ="seq2" value="<?php  print($secondSequence); ?>"disabled></input>
            </div>
            <div>
                <button type="submit" name="generate" value="generate">Generate</button>
            </div>
            <p> <?php echo "Number of non coincidents positions: ".$noCoind;?> </p>
            
            
        </fieldset>
    </form>
</body>
</html>