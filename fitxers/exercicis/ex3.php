<?php
//Programa que permet pujar fitxers amb texts, així com seleccionar-ne un dels pujats i 
//mostrar el seu contingut en un texarea (tot en la mateixa pàgina).


if (!is_null(filter_input(INPUT_POST, "add"))) {
    $fileToAdd = filter_input(INPUT_POST, "file");
    echo $fileToAdd ;

    if (!is_null($fileToAdd)) {

        print_r($_FILES);
    }

    
}


function readChosedFile ($pathFile) : string {
    $content = "";
    if (!file_get_contents($pathFile)) {
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
    <form action= "<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="form-upload" method = "post">
        <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="35000" />
            <input type="file" name="file" />
        </p>
        <button type ="submit" name="add">Add</button>

        <!--list files -->

        <!--chose which file to read -->
        <div>
            <label for="fileToRead">File to read: </label>
            <input type="text" name="fileToRead">
        </div>
        <div id="result">
            <textarea name="result" id="" cols="30" rows="10"><?php echo $result; ?></textarea>
        </div>

    <form>
</body>
</html>