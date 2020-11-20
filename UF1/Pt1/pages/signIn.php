<?php
include_once "../functions/functions.php";
$filePath = "../files/users.txt";
$message = "";

if (!is_null(filter_input(INPUT_POST, "register"))) {
    //variables
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    $newUser = array ($username, $password, "registered", $name, $surname, $email);

    //validate
    if (checkUniqueUsername($username, $filePath)) {
        //transformem line en un string
        $stringNewLine = implode(";", $newUser);

        if(file_put_contents($filePath, $stringNewLine.PHP_EOL, FILE_APPEND | LOCK_EX)) {
            header("Location:index.php");  //redirect to application page
            $message =  "User ".$username." correctly registered";
        }
    } else $message = "This username already exists";
    
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
                        <input type="text" class="form-control" name="name" placeholder="Name" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="surname" class="col-sm-2 col-form-label">Surname: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="surname" placeholder="Surname" required>
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
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>
                </div>


            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
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
