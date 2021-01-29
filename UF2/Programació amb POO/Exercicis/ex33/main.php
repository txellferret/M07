<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Animals example</title>
    </head>
    <body>
<?php
require_once 'classes/speaker.interface.php';
require_once 'classes/animal.class.php';
require_once 'classes/dog.class.php';

// methods

function printSpeakerInfo(Speaker $speaker) {
    echo sprintf("<li> %s, talk= %s</li>", $speaker, $speaker->talk());
}
/**
 * prints a list of speakers
 * @param Shape $shapeList
 */
function printSpeakers(array $speakersList) {
    echo "<p>Printing ", count($speakersList), " elements</p>";
    echo "<ul>";
    foreach ($speakersList as $elem) {
        printSpeakerInfo($elem) ;
    }
    echo "</ul>";
}

//define a list of speakers.
$mySpeakers = array();
//populate the list with new speakers.
array_push($mySpeakers, new Dog("Bobby"));
var_dump($mySpeakers);
//print shapes information.
printSpeakers($mySpeakers);
?>
    </body>
</html>
