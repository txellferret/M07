<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify users</title>
</head>
<body>
    <h2>Modify users</h2>
<?php

    include_once "UserPdoDbDao.php";
    include_once "User.php";
    $dao = new UserPdoDbDao();

    $userNew = new User(8, "txell", "caca", "registered");
    $rows = $dao->update($userNew);
    if ($rows > 0){
        echo "<p> Successfully modified </p>";
    } else {
        echo "<p> Unsuccessfully modified </p>";
    }
    


?>
</body>
</html>