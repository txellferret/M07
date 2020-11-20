<?php
session_start();
if($_SESSION['userRole'] != "admin") {
    header("Location:login.php");
}

$username = $_GET['id'];
$filePathUsers = "../files/users.txt";
include "../functions/functions.php";

$divStyleResult='block'; // hide div

$user = findLine($filePathUsers,$username);
$roles = array("registered", "staff", "admin");

$message = "";
$allDoc =file($filePathUsers);

if (!is_null(filter_input(INPUT_GET, "save"))) {
    
    //variables
    $username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_GET, 'password', FILTER_SANITIZE_STRING);
    $role = trim((string)filter_input(INPUT_GET, 'role'));
    $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
    $surname = filter_input(INPUT_GET, 'surname', FILTER_SANITIZE_STRING);
    
    //validate 
    if(checkUniqueUsername($username, $filePathUsers)){

        $modifiedUser = array ($username, $password, $role, $name, $surname);
        if ($result = editFile($modifiedUser, $allDoc)) {
            
            if ($r = saveChangesToFile($filePathUsers, $allDoc)) {
                $divStyleResult='none'; // hide div
                $message = "Changes successfully changed";
                
            } else $message = "Changes Unsuccessfully changed";
        }

    } else {
        $message =  "This username already exists";
    }
}

if (!is_null(filter_input(INPUT_GET, "delete"))) {
    //username to delete
    $username = filter_input(INPUT_GET, 'username');
    global $allDoc;
    $user = findLine($filePathUsers,$username);
    $d = implode(";", $user);
    
    if (($key = array_search($d, $allDoc)) !== false) {
        unset($allDoc[$key]);
        if ($r = saveChangesToFile($filePathUsers, $allDoc)) {
            $divStyleResult='none'; // hide div
            $message = "User successfully deleted";
        }
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
        <div class="card mt-5" style="width: 100%;">
        <div class="card-header text-center"><h4>Modify User</h4></div>
            <div class="card-body">
                <form name="modify-form" method="get" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"style="display: <?= $divStyleResult?>">
                    <div class="form-group row">
                        <label for="id" class="col-sm-2 col-form-label">Username: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" value = "<?php echo $user[0] ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="col-sm-2 col-form-label">Password: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="password" value = "<?php echo $user[1]; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dish" class="col-sm-2 col-form-label">Role: </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="category">
                                <?php selectCategories($roles, $user[2]) ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label">Name: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value = "<?php  echo $user[3]; ?>"required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label">Surname: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="surname" value = "<?php  echo $user[4]; ?>"required>
                        </div>
                    </div>
                    <div class="form-group row justify-content-between">
                        <div class="col-10">
                            <button type="submit" class="btn btn-success" name="save">Save changes</button>
                            <button onclick="return confirm('Are you sure you want to delete?')"  class="btn btn-danger" name="delete">Delete User</button>
                        </div>
                        <div class="col-1 mr-3">
                            <button type="button" class="btn btn-secondary"><a href ="adminUsers.php" style="color: white; text-decoration: none">Cancel</a></button>  
                        </div>
                    </div>
                </form>
                <div ><?php echo $message ?></div>
            </div>
        </div> 
    </div>
</body>
<?php include "footer.php";?>
</html>