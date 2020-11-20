<?php
session_start();

$path = "../files/";
$inputFile = "users.txt";

$userWrong = "";
$message = "";

if (!is_null(filter_input(INPUT_POST,'submit'))) {
    $userInput = filter_input(INPUT_POST, "userName");
    $passwordInput = filter_input(INPUT_POST, "password");

    //validations.
    if ((trim($userInput) === "") || (trim($passwordInput) === "")) {
        $message = "<li>User and password required.</li>";
    }
    else {
        //assess file existance
        if (!file_exists($path.$inputFile)) {
            echo "File not found";
            header("Location:index.php");  //redirect to application page

        }   
    
        //read file into an array of lines
        $lines = file($path.$inputFile);
    
        for ($i=0; $i < count($lines); $i++) { 
            $userPass = explode(";", $lines[$i]);
            if (strcmp($userPass[0], $userInput) === 0) {
                if (strcmp(trim($userPass[1]), $passwordInput) === 0) {
                    $_SESSION["loggedin"] = true;
                    $_SESSION["userRole"] = $userPass[2];
                    $_SESSION["userName"] = $userPass[0];
                        header("Location:index.php");  //redirect to application page
                        exit;

                } else $message = "<b>Invalid password</b>";
    
            break;
            } else { //bad login: redirect to login page again.
                $userWrong = $userInput;
                $message = "<b>Invalid user</b>";
                
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
    <!--css files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">


    <title>Document</title>
</head>

<body background="../images/mesas.jpg">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a id="brand" class="navbar-brand" href="../index.php">Italian Restaurant</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" href="../index.php">Home <span class="sr-only">(current)</span></a>
                <a class="nav-link" href="dayMenu.php">Day Menu</a>
                <a class="nav-link" href="signIn.php">Register</a>
                <a class="nav-link" href="login.php">Login</a>
            </div>
        </div>
    </nav>
    <div class="container ">
        <div class="card mt-5" style="width: 100%;">
            <div class="card-body">
                <form name="login-form" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                    <fieldset>
                        <legend>Log in into the restaurant clients!</legend>
                        <label for="userName">Username:</label>
                        <input type="text" name="userName" value ="<?php echo $userWrong?>"></input>
                        <label for="password">Password:</label>
                        <input type="password" name="password">
                        <br>
                        <br>
                        <button class="btn btn-secondary" type="submit" name="submit">Submit</button>
                        <p><?php echo $message?> </p>
                    </fieldset>
                </form>
            </div>
        </div>
        
    </div>
    <?php include "footer.php";?>
</body>
</html>
