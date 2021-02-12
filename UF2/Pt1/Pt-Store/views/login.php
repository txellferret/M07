<h2>Log in!</h2>

<form action="index.php?action=login" method="post">
    <label for="username">Username: </label>
    <input type="text" name="username" id="username"> <br>

    <label for="username">Password: </label>
    <input type="password" name="password" id="password"><br>

    <button class="btn btn-primary" type="submit" name="submit">Login!</button>

    
</form>
<br>
<?php 
    if(isset($params['errorLogin'])) echo $params['errorLogin'];
    ?>