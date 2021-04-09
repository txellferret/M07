<?php

$roles = $params['listRoles']??null;
$action = $params['action']??null;

?>
<form action="" method="post">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Username: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="username" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="category" class="col-sm-2 col-form-label">Password: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="password" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="dish" class="col-sm-2 col-form-label">Role: </label>
        <div class="col-sm-10">
            <select class="form-control" name="role">
                <?php 
                foreach ($roles as $v) {
                    echo "<option>".$v."</option>";
                }
               ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="price" class="col-sm-2 col-form-label">Name: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="price" class="col-sm-2 col-form-label">Surname: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="surname" required>
        </div>
    </div>

    <?php
    if($action == "add") {
        echo "<button type='submit' class='btn btn-success' name ='addUser'>Add User</button>";
    } elseif($action == "edit") {
        echo "<button type='submit' class='btn btn-primary' name ='editUser'>Edit User</button>";
    }
    ?>
    <button type="button" class="btn btn-secondary"><a href ="index.php" style="color: white; text-decoration: none">Cancel</a></button> 
    
</form>