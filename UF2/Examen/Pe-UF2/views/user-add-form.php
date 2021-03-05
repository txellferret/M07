
<?php
   $u = $params['user']??null;  //?? is the 'null coalescing operator'.
   $action = $params['action']??"findUser";// si la var action no esta ddefinida, return null (normalment)

   // Si posem ??, dona com a valor per defecte el valor de la dreta si retorna null i la inicialitza

   $result = $params['result']??null;
   if (is_null($u)) {
       $u = new User();
   }
   if (!is_null($result)) {
       echo "<div><p class=\"alert\">$result</p></div>";
   }
?>
<form id="user-form" method="post" action="index.php">

        <label for="username">Username: </label><input type="text" name="username" id="username" placeholder="enter username" value=" <?php $u->getUsername() ?>"/>
        <label for="password">Password: </label><input type="text" name="password" id="password" placeholder="enter password" value="<?php $u->getPassword()?>"/>
        <label for="age">Age: </label><input type="number" name="age" id="age" value=" <?php $u->getAge()?>"/>
        <label for="role">Role: </label>
        <select name="role" id="role">
            <option value="admin">Admin</option>
            <option value="registered" selected="selected">Registered</option>
            
        </select>
        <label for="activated">Activated</label>
        <input type="radio" id="activated" name="active" value="true">
        <label for="nonActivated">nonActivated</label>
        <input type="radio" id="nonActivated" name="active" value="false" checked="checked"> <br>


    <button class="btn btn-primary" type="submit" <?php if (!isset($_SESSION['userRole']) || ($_SESSION['userRole']=='registered')) echo 'disabled' ;?>>Add</button>
    <input name="action" hidden="hidden" value="user/add"/>

</form>