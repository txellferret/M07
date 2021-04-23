<?php

$roles = $params['listRoles']??null;
$action = $params['action']??null;
$result = $params['result']??null;
$userFound = $params['usrToModify']??null;

$error = $params['error'] ?? null;
if (!is_null($result)) {
    echo <<<EOT
    <div><p class="alert">$result</p></div>
EOT;
}
if (!is_null($error)) {
    echo <<<EOT
    <div><p class="alert">$error</p></div>
EOT;
}  
?>
<form action="" method="post">
    <input type="text" class="form-control" name="id"  value= "<?php if(!is_null($userFound)) echo $userFound->getId();?>" hidden>
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Username: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="username" value= "<?php if(!is_null($userFound)) echo $userFound->getUsername();?>"required>
        </div>
    </div>

    <div class="form-group row">
        <label for="category" class="col-sm-2 col-form-label">Password: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="password" value= "<?php if(!is_null($userFound)) echo $userFound->getPassword();?>"required>
        </div>
    </div>

    <div class="form-group row">
        <label for="dish" class="col-sm-2 col-form-label">Role: </label>
        <div class="col-sm-10">
            <select class="form-control" name="role" value= "<?php if(!is_null($userFound)) echo $userFound->getRole();?>">
                <?php 
                foreach ($roles as $v) {
                    echo "<option value='".$v."'>".$v."</option>";
                }
               ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="price" class="col-sm-2 col-form-label">Name: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" value= "<?php if(!is_null($userFound)) echo $userFound->getFirstname();?>" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="price" class="col-sm-2 col-form-label">Surname: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="surname" value= "<?php if(!is_null($userFound)) echo $userFound->getLastname();?>" required>
        </div>
    </div>

    <?php
    if($action == "add") {
        echo "<button type='submit' class='btn btn-success' name ='action' value='addUser'>Add User</button>";
    } elseif($action == "edit") {
        echo "<button type='submit' class='btn btn-primary' name ='action' value='editUser'>Edit</button>";
        echo "<button type='submit' class='btn btn-danger' onclick='return confirmDialog()' name ='action' value='deleteUser'>Delete</button>";
    }
    ?>
    <button type="button" class="btn btn-secondary"><a href ="index.php?action=user" style="color: white; text-decoration: none">Cancel</a></button> 
    
</form>

<script>
function confirmDialog() {
    return window.confirm("Are you sure?");
}

</script>