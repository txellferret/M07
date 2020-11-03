<?php
//Programa que permet pujar fitxers amb texts, així com seleccionar-ne un dels pujats i 
//mostrar el seu contingut en un texarea (tot en la mateixa pàgina).

$divStyleResult='none'; // hide div
$dir_upload = 'files/uploads/';
$errors = "";
$listFiles = array();



//add file to directory
if (!is_null(filter_input(INPUT_POST, "add"))) {

    //get uploaded file path.
    $uploadFile = $dir_upload.basename($_FILES['userFile']['name']);
    //move the file from temporal to the correct destination (fileName, path of destination)
    if (move_uploaded_file($_FILES['userFile']['tmp_name'], $uploadFile)) {
        $errors = "Upload with exit";
    } else {
        $errors = "An error ocurred :(";
    }
}

if (!is_null(filter_input(INPUT_POST, "read"))) {
    //variables
    $selectedFile = filter_input(INPUT_POST, "choosed");

    if (!is_null($selectedFile)) {
        $result = readChosedFile ($dir_upload.$selectedFile);
        $divStyleResult='block'; // show div
       
    } else $message="Select a file";

}

if ($handle = opendir($dir_upload)) {
    //iterate in the directory
    while (($entrada = readdir($handle))!== false) {
        if(!is_dir($entrada)) {
            array_push($listFiles, $entrada);
        }
    }
    closedir($handle);
} else exit("Error ocurred");

$files = printArray ($listFiles);

/**
 * Prints an array in a readeable format
 * @param array to print
 * @return a string with all elements
 */
function printArray ($arrayToPrint) : string {
    $list ="";
    for ($i=0; $i < count($arrayToPrint); $i++) { 
        $list .="<label><input type=\"radio\" value=".$arrayToPrint[$i]." name=\"choosed\">".$arrayToPrint[$i]."</label><br>";
    }
    return $list;
}


function readChosedFile ($pathFile) : string {
    $content = "";
    if (file_get_contents($pathFile)) {
        $content = file_get_contents($pathFile);
    }

    return $content;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ex3</title>
</head>
<body>
<h1>Upload files</h1>
    <form action= "<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="form-upload" method = "post" enctype="multipart/form-data">
        <!--Upload file-->
        <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="35000" />
            <input type="file" name="userFile" />
        </p>
        <button type ="submit" name="add">Add</button>
        <p><?php echo $errors ?></p>

        <!--list files -->
        <h3>List of upload files</h3>
        <h5>Choose a file:</h5>
        <div id="listOfFiles">
            <p><?php echo $files ?></p>
        </div>
        
        <!--chose which file to read -->
        <div>
            <button type ="submit" name="read">Read</button>
        </div>
        
        <div id="result" style="display: <?= $divStyleResult?>">
            <textarea name="result" id="" cols="30" rows="10"><?php echo $result; ?></textarea>
            <p><?php echo $message ?></p>
        </div>

    <form>
</body>
</html>