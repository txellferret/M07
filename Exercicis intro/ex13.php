<?php
//Programa que donada la seqüència d'aminoàcids d'una proteïna, 
//mostra una seqüència de nucleòtids que la codifiqui.


include "fn-sequences.php";

$divStyleRNA='none'; // hide div

/**Main */
if (!is_null(filter_input(INPUT_GET,'analize'))) { //if button is clicked

    $inputSeq = strtoupper(filter_input(INPUT_GET, "seqAA"));

    if (checkValidSequence($inputSeq, AA)) {
        $aminoacids = splitsSeqRNA ($inputSeq,1);
        $seqRNA = convertToNucleotids ($aminoacids);
    
    }else $errors = "Invalid sequence";

    $divStyleRNA='block'; //show div
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
