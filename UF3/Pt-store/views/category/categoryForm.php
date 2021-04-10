<?php

$action = $params['action']??null;
$result = $params['result']??null;

if (!is_null($result)) {
    echo <<<EOT
    <div><p class="alert">$result</p></div>
EOT;
}  
?>
<form action="" method="post">
    <div class="form-group row">
        <label for="code" class="col-sm-2 col-form-label">Code: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="code" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="description" class="col-sm-2 col-form-label">Description: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="description" required>
        </div>
    </div>


    <?php
    if($action == "add") {
        echo "<button type='submit' class='btn btn-success' name ='action' value='addCategory'>Add Category</button>";
    } elseif($action == "edit") {
        echo "<button type='submit' class='btn btn-primary' name ='action'>Edit Category</button>";
    }
    ?>
    <button type="button" class="btn btn-secondary"><a href ="index.php" style="color: white; text-decoration: none">Cancel</a></button> 
    
</form>