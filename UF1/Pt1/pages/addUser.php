<?php
session_start();
if($_SESSION['userRole'] != "admin") {
    header("Location:login.php");
}
$filePathUsers = "../files/users.txt";
include "../functions/functions.php";

//list of available roles
$roles = array("registered", "staff", "admin");

if (!is_null(filter_input(INPUT_GET, "addUser"))) {

    //variables
    $username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_GET, 'password', FILTER_SANITIZE_STRING);
    $role = trim((string)filter_input(INPUT_GET, 'role'));
    $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
    $surname = filter_input(INPUT_GET, 'surname', FILTER_SANITIZE_STRING);

    //validate 
    if(checkUniqueUsername($username, $filePathUsers)){

        $newUser = array ($username, $password, $role, $name, $surname);
        $lineUser = implode(";", $newUser);

        if (file_put_contents($filePathUsers, $lineUser.PHP_EOL, FILE_APPEND | LOCK_EX)) {
            $message = "User successfully added";
        }else {
            $message = "User UNsuccessfully added";
        }

    } else {
        $message =  "This username already exists";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body background="../images/mesas.jpg">
<?php include_once "topMenu.php"; ?>
    <div class="container ">
        <div class="card mt-5 mb-5" style="width: 100%;">
            <div class="card-header text-center"><h4>Add new User</h4></div>
                <div class="card-body">
                <form id = "myForm" name="user-form" method="get" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Username: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-sm-2 col-form-label">Password: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dish" class="col-sm-2 col-form-label">Role: </label>
                            <div class="col-sm-10">
                            <select class="form-control" name="role">
                                <?php selectCategories($roles, "none") ?>
                            </select>
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Name: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Surname: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="surname" required>
                            </div>
                        </div>

                        <div class="form-group row justify-content-between">
                            <div class="col-10">
                                <button type="submit" class="btn btn-success" name ="addUser">Add User</button>
                                <button onlick = "clearFields()"  class="btn btn-primary" name ="clear">Clear</button>
                            </div>
                            <div class="col-1 mr-3">
                                <button type="button" class="btn btn-secondary"><a href ="adminUsers.php" style="color: white; text-decoration: none">Cancel</a></button>  
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

<!-- Script to clear fields -->
<script>
    function clearFields() {
        document.getElementById("myForm").reset();
        
    }
</script>