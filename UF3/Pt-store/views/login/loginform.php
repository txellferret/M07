
<h2>Log in!</h2>
<?php
$disabled = "";
$result = $params['errorLogin']??null;
$d = $params['alreadyLogged']??null;
if (!is_null($result)) {
    echo "<div><p class='alert'>$result</p></div>";
}

if (!is_null($d)) {
    echo "<div><p class='alert'>$d</p></div>";
    $disabled = "disabled";

}

?>

<form id="login-form" action="index.php" method="post">
    <label for="username">Username: </label>
    <input type="text" name="username" id="username"> <br>

    <label for="username">Password: </label>
    <input type="password" name="password" id="password"><br>

    <button id ="bt-login" type="submit" name="action" value="userLogin" <?php echo $disabled?>>Send</button>
    
</form>