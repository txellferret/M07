<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List users</title>
</head>
<body>
    <h2>List users</h2>
<?php
    include "Renderer.php";
    include "UserPdoDbDao.php";
    $dao = new UserPdoDbDao();
    $list = $dao->selectAll();
    echo "<p>Number of elements retrieved: " . count($list) . "</p>";
    echo Renderer::renderArrayOfUsersToTable(
         ["id", "username", "password", "role"],
         $list
     );
?>
</body>
</html>