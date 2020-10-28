<?php
//Programa que valida nom d'usuari i paraula de pas. Les dades estan en un fitxer.

//path and filename definitions.
$path = "files/";
$inputFile = "users.txt";

if (!is_null(filter_input(INPUT_POST, "send"))) {
    $userInput = filter_input(INPUT_POST, "user");
    $password = filter_input(INPUT_POST, "password");

    //validations.
    if ((trim($userInput) === "") || (trim($password) === "")) {
        $message = "<li>User and password required.</li>";
    }
    else {
        //assess file existance
        if (!file_exists($path.$inputFile)) {
            exit("File not found");
        }   
    
        //read file into an array of lines
        $lines = file($path.$inputFile);
    
        for ($i=0; $i < count($lines); $i++) { 
            $userPass = explode(":", $lines[$i]);
            if (strcmp($userPass[0], $userInput) === 0) {
                if (strcmp(trim($userPass[1]), $password) === 0) {
                    $message = "<b>Valid access</b>";
                } else $message = "<b>Invalid password</b>";
    
            break;
            } else $message = "<b>Invalid user</b>";
        }
    }   
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ex1</title>
</head>
<body>
    <h1>User validation</h1>
    <form action= "<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="form-welcome" method = "post">
        <label for="user">User: </label>
        <input type="text" name="user">
        <br>
        <label for="password">Password: </label>
        <input type="password" name="password">
        <br>
        <br>
        <button type ="submit" name="send">Enter</button>
        <p><?php echo $message?> </p>
    
    
    
    </form>
</body>
</html>
