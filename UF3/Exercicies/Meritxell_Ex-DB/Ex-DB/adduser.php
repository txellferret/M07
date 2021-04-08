<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add users</title>
</head>
<body>
    <h2>Add users</h2>
<?php

    include_once "UserPdoDbDao.php";
    include_once "User.php";
    $dao = new UserPdoDbDao();

    $userNew = new User(0, "txell", "123456", "registered");
    $rows = $dao->insert($userNew);
    if ($rows > 0){
        echo "<p> Successfully inserted </p>";
    } else {
        echo "<p> Unsuccessfully inserted </p>";
    }
    


?>
</body>
</html>