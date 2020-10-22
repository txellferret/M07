<?php
//Programa que calcula la seqüència complementària a una donada.


include "fn-sequences.php";
$errors ="";

if (!is_null(filter_input(INPUT_GET,'calculate'))) { //if button is clicked

    $inputSeq = filter_input(INPUT_GET, "seq");
    if (filter_input(INPUT_GET, 'type-radio') == "dna"){
        if (checkValidSequence ($inputSeq, DNACHARS)){
            $complementarySeq= complementarySequence($inputSeq, "dna");
        } else $errors= "wrong sequence";
    } elseif (filter_input(INPUT_GET, 'type-radio') == "rna") {
        if (checkValidSequence ($inputSeq, RNACHARS)){

            $complementarySeq= complementarySequence($inputSeq, "rna");
        } else $errors= "wrong sequence";
    } else {
        $errors= "Mark type sequence!";
    }
}

/**
 * Gets the complementary sequence of nucleotids
 * @param sequence of nucleotids
 * @param type if it is DNA or RNA
 */
function complementarySequence(string $x, string $type) {
    $finalSeq = " ";
    for($i=0;$i<strlen($x);$i++) {
        switch ($x[$i]) {
            case "A":
                if ($type == "dna") {
                    $finalSeq = $finalSeq."T";
                } else $finalSeq = $finalSeq."U";  
            break;
            case "T":
                $finalSeq = $finalSeq."A";
            break;
            case "G":
                $finalSeq = $finalSeq."C";
            break;
            case "C":
                $finalSeq = $finalSeq."G";
            break;
            case "U":
                $finalSeq = $finalSeq."A";
            break;
        };

    }
    return $finalSeq;
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
    <h1>Complementary DNA sequence</h1>
    <form name="complementary-form" method="get" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <fieldset>
        <legend>Complementary DNA sequence</legend>
            <div>
                <label for="seq1">Sequence </label>
                <input type="text" name="seq" id ="seq" value="<?php  print($inputSeq); ?>"></input>
            </div>
            <div>
                <input type="radio" id="dna" name="type-radio" value="dna" >
                <label for="male">DNA</label>
                <input type="radio" id="rna" name="type-radio" value="rna">
                <label for="rna">RNA</label>
            </div>
            <div>
                <button type="submit" name="calculate" value="calculate">Calculate complementary</button>
            </div>
            </div>
                <label for="seqComp">Complementary sequence </label>
                <input type="text" name="seqComp" id ="seqComp" value="<?php  print($complementarySeq); ?>" disabled></input>

                <p> <?php echo $errors;?> </p>
            </div>


</body>
</html>