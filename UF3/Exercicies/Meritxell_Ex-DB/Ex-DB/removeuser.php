<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove users</title>
</head>
<body>
    <h2>Remove users</h2>
<?php

    include_once "UserPdoDbDao.php";
    include_once "User.php";
    $dao = new UserPdoDbDao();

    $userNew = new User(7, "txell", "123456", "registered");
    $rows = $dao->delete($userNew);
    if ($rows > 0){
        echo "<p> Successfully removed </p>";
    } else {
        echo "<p> Unsuccessfully removed </p>";
    }

?>
</body>
</html>