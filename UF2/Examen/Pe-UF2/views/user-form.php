<script type="text/javascript">
function submitForm(event) {
    var target = event.target;
    var buttonId = target.id;
    var myForm = document.getElementById('user-form');
    myForm.action.value = buttonId;
    myForm.submit();
    return false;
}
</script>
<?php
   $u = $params['user']??null;  //?? is the 'null coalescing operator'.
   $action = $params['action']??"findUser";// si la var action no esta ddefinida, return null (normalment)

   // Si posem ??, dona com a valor per defecte el valor de la dreta si retorna null i la inicialitza

   $result = $params['result']??null;
   if (is_null($u)) {
       $u = new User();
   }
   $disable = (($action == "findUser")||($action == "user/form"))?"disabled":"";
   if (!is_null($result)) {
       echo "<div><p class=\"alert\">$result</p></div>";

   }   
   echo <<<EOT
   <form id="user-form" method="post" action="index.php">
    <fieldset>
        <label for="username">Username: </label><input type="text" name="username" id="username" placeholder="enter username" value="{$u->getUsername()}"/>
        <label for="password">Password: </label><input type="text" name="password" id="password" placeholder="enter password" value="{$u->getPassword()}" disabled/>
        <label for="age">Age: </label><input type="text" name="age" id="age" placeholder="enter age" value="{$u->getAge()}" disabled/>
        <label for="role">Role: </label><input type="text" name="role" id="role" placeholder="enter role" value="{$u->getRole()}" disabled/>
        <label for="activated">Activated: </label><input type="text" name="activated" id="activated"  value="{$u->isActive()}" disabled/>

   </fieldset>
    <fieldset>
        <button type="button" id="user/find" name="user/find" onclick="submitForm(event);return false;">Find</button>
        <button type="button" id="user/modify" name="user/modify" {$disable} onclick="submitForm(event);return false;">Modify</button>
        <button type="button" id="user/remove" name="user/remove" {$disable} onclick="submitForm(event);return false;">Remove</button>
        <input name="action" id="action" hidden="hidden" value="add"/>
    </fieldset>
</form>
EOT;

?>