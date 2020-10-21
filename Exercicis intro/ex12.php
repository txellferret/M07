<?php
//Programa que validi una seqüència de ADN o ARNm (seleccionar amb un selector) indiqui el nombre de vegades i el 
//percentatge que apareix cada nucleòtid i el nombre d'errors.

$divStyleDNA='none'; // hide div
$divStyleRNA='none'; // hide div
$countersDNA = array (
    'a' => 0,
    'g' => 0,
    'c' => 0,
    't' => 0,
    'errors'=> 0
);
$countersRNA = array (
    'a' => 0,
    'g' => 0,
    'c' => 0,
    'u' => 0,
    'errors'=> 0
);


if (!is_null(filter_input(INPUT_GET,'analize'))) { //if button is clicked

    $inputSeq = filter_input(INPUT_GET, "seq");
    if (filter_input(INPUT_GET, 'form_select') == "dna"){
        countNucleotids ($inputSeq, "dna");
        $divStyleDNA='block'; //show div
        

    } else {
        countNucleotids ($inputSeq, "rna");
        $divStyleRNA='block'; //show div
    }

}

/**
 * Count the number of nucleotids and update the counters array
 * @param sequence to count nucleotids
 * @param typeSeq if it is DNa or RNA
 */
function countNucleotids ($sequence, $typeSeq){
    global $countersDNA;
    global $countersRNA;
    global $errors;
    if ($typeSeq== "dna") {
        for ($i=0; $i<strlen($sequence); $i++) {
            switch (strtoupper($sequence[$i])){
                case 'A':
                    $countersDNA['a'] += 1;
                break;
                case 'T':
                    $countersDNA['t'] += 1;
                break;
                case 'G':
                    $countersDNA['g'] += 1;
                break;
                case 'C':
                    $countersDNA['c'] += 1;
                break;
                default:
                    $countersDNA['errors'] += 1;
                break;
            }
        }
    } else {
        for ($i=0; $i<strlen($sequence); $i++) {
            switch (strtoupper($sequence[$i])){
                case 'A':
                    $countersRNA['a'] += 1;
                break;
                case 'U':
                    $countersRNA['u'] += 1;
                break;
                case 'G':
                    $countersRNA['g'] += 1;
                break;
                case 'C':
                    $countersRNA['c'] += 1;
                break;
                default:
                    $countersRNA['errors'] += 1;
                break;
            }
        }
    }
    
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Analize sequences</title>
</head>
<body>
    <form name="analize-form" method="get" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <fieldset>
        <legend>Analize sequence</legend>
            <div>
                <label for="seq">Sequence </label>
                <input type="text" name="seq" id ="seq" value="<?php  print($inputSeq); ?>"></input>
            </div>
            <div>
                <label>Select option:</label>
				<select name="form_select">
					<option value="dna">DNA</option>
					<option value="rna">RNA</option>
				</select>
            </div>
            <div>
                <button type="submit" name="analize" value="analize">Analize</button>
            </div>
            <div id="dna" style="display: <?= $divStyleDNA?>">
                <table border="1">
                    <tr>
                        <th colspan="2">Adenina</th>
                        <th colspan="2">Timina</th>
                        <th colspan="2">Guanina</th>
                        <th colspan="2">Citosina</th>
                    </tr>
                    <tr>
                        <td> <?php echo $countersDNA['a'];?></td>
                        <td> <?php echo $countersDNA['a']/strlen($inputSeq)*100 ."%";?></td>
                        <td> <?php echo $countersDNA['t'];?></td>
                        <td> <?php echo $countersDNA['t']/strlen($inputSeq)*100 ."%";?></td>
                        <td> <?php echo $countersDNA['g'];?></td>
                        <td> <?php echo $countersDNA['g']/strlen($inputSeq)*100 ."%";?></td>
                        <td> <?php echo $countersDNA['c'];?></td>
                        <td> <?php echo $countersDNA['c']/strlen($inputSeq)*100 ."%";?></td>
                     </tr>
                </table>
                <p> <?php echo "Errors: " . $countersDNA['errors']?> </p>
            </div>

            <div id="rna" style="display: <?= $divStyleRNA?>">
                <table border="1">
                    <tr>
                        <th colspan="2">Adenina</th>
                        <th colspan="2">Uracil</th>
                        <th colspan="2">Guanina</th>
                        <th colspan="2">Citosina</th>
                    </tr>
                    <tr>
                        <td> <?php echo $countersRNA['a'];?></td>
                        <td> <?php echo $countersRNA['a']/strlen($inputSeq)*100 ."%";?></td>
                        <td> <?php echo $countersRNA['u'];?></td>
                        <td> <?php echo $countersRNA['u']/strlen($inputSeq)*100 ."%";?></td>
                        <td> <?php echo $countersRNA['g'];?></td>
                        <td> <?php echo $countersRNA['g']/strlen($inputSeq)*100 ."%";?></td>
                        <td> <?php echo $countersRNA['c'];?></td>
                        <td> <?php echo $countersRNA['c']/strlen($inputSeq)*100 ."%";?></td>
                     </tr>
                </table>
                <p> <?php echo "Errors: " . $countersRNA['errors']?> </p>
            </div>
            
        </fieldset>
    </form>
    
</body>
</html>