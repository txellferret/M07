<h2>Log in!</h2>
<?php
$result = $params['errorLogin']??null;
if (!is_null($result)) {
    echo "<div><p class='alert'>$result</p></div>";
}

?>

<form id="login-form" action="index.php" method="post">
    <label for="username">Username: </label>
    <input type="text" name="username" id="username"> <br>

    <label for="username">Password: </label>
    <input type="password" name="password" id="password"><br>

    <button type="submit" >Send</button>
    <input name="action" hidden="hidden" value="userLogin"/>
    
</form>

