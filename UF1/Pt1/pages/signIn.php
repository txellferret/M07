<?php

$filePath = "../files/users.txt";
$message = "";

if (!is_null(filter_input(INPUT_POST, "register"))) {
    //variables
    $name = filter_input(INPUT_POST, 'name');
    $surname = filter_input(INPUT_POST, 'surname');
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    $newUser = array ($username, $password, "registered", $name, $surname, $email);

    //validate
    $validFields = false;
    for ($i=0; $i <count($newUser) ; $i++) { 
        if (!validateField($newUser[$i])){
            $message = "Not valid fields";
        break;
        }
        else $validFields = true;
    }

    if ($validFields) {
        if (checkUniqueUsername($username, $filePath)) {
            //transformem line en un string
            $stringNewLine = implode(";", $newUser);

            if(file_put_contents($filePath, $stringNewLine.PHP_EOL, FILE_APPEND | LOCK_EX)) {

                header("Location:index.php");  //redirect to application page
                $message =  "User ".$username." correctly registered";
            }
        } else $message = "This username already exists";
    }
}
/**
 * Validates a field if it is not empty or if is not false according to the filter_inputs
 * @param field to validate
 * @return true if it is valid, false otherwise
 */
function validateField ($field) :bool {
    $valid = false;
    if ($field !=="" && $field !== false){
        $valid = true;
    }
    return $valid;

}
/**
 * Checks if a given username already exits in a data file
 * @param username to check
 * @param filepath to search
 * @return true if it is unique, false otherwise
 */
function checkUniqueUsername ($username, $filePath) : bool {
    $unique = true;
    $handle = fopen($filePath,'r');
    //posem 0 per omitir caracters de fi de linea
    while (($row = fgetcsv($handle,0,";")) !== FALSE) {
        $numero = count($row);
        if ($row[0] === $username) {
            $unique = false;
        break;
        }

    }
    
    fclose($handle);
    return $unique;
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
<?php include_once "topMenu.php"; ?>

<div class="container ">
    <div class="card mt-5" style="width: 100%;">
        <div class="card-body">
            <form name="register-form" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="surname" class="col-sm-2 col-form-label">Surname: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="surname" placeholder="Surname">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                </div>


            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
                <button type="submit" class="btn btn-secondary" name ="register">Sign in</button>
                </div>
            </div>
            <p><?php echo $message?></p>

            </form>
        </div>
    </div>
</div>
<?php include "footer.php";?>
</body>
</html>
