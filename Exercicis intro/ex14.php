<?php
//Programa que donada una seqüència de nucleòtids, 
//indiqui la seqüència d'aminoàcids en què s'expressa (amb lletra i nom).

include "fn-sequences.php";
$divStyleAA='none'; // hide div

$errors = "0";

/**Main */
if (!is_null(filter_input(INPUT_GET,'analize'))) { //if button is clicked
    $inputSeq = strtoupper(filter_input(INPUT_GET, "seq"));
    if (checkValidSequence($inputSeq, RNACHARS)) {
        $arrayCodons = splitsSeqRNA ($inputSeq,3);
        $AA = convertToAA ($arrayCodons);

        //converts to their AA names
        $AAname = convertNameAA($AA);

    } else $errors = "Invalid sequence";
    $divStyleAA='block'; //show div
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
                <label for="seq"><b>RNA</b> sequence </label>
                <input type="text" name="seq" id ="seq" value="<?php  print($inputSeq); ?>"></input>
            </div>
            <div>
                <button type="submit" name="analize" value="analize">Analize</button>
            </div>
            <div id="aa" style="display: <?= $divStyleAA?>">
                <p><?php echo "Aminoacid sequence: ".$AA?> </p>
                <p><?php echo "Aminoacid sequence name: ".$AAname?> </p>
                <p> <?php echo "Errors: " . $errors?> </p>
            </div>
        </fieldset>
    </form>
</body>
</html>