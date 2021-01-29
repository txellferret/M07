<?php
session_start();
if($_SESSION['userRole'] != "admin") {
    header("Location:login.php");
}

$path = "../files/";
$inputFileUsers = "users.txt";

//array of each user with its properties
$usersProperties = file($path.$inputFileUsers);

include_once "../functions/functions.php"



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
        <div class="card mt-5 mb-5" style="width: 100%;">
            <div class="card-header text-center"><h4>Users administration</h4></div>
            
            <table class="table text-center">
                <thead class="thead-light"><tr><th>Username</th><th>Password</th><th>Role</th><th>Name</th><th>Surname</th></tr></thead>
                <tbody>
                    <?php listInput($usersProperties, "User"); ?>
                <tbody>
                
            </table>
            <div >
                <button type="button" class="btn btn-danger"><a href ="addUser.php" style="color: white; text-decoration: none">Add User</a></button>  
            </div>
             
        </div>
            <br>
            <br>
            <br>
        </div>
    <?php include "footer.php";?>
</body>
</html>

