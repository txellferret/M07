<?php
session_start();
if($_SESSION['userRole'] != "admin" && $_SESSION['userRole'] != "staff" ) {
    header("Location:login.php");
}

$id = $_GET['id'];
$filePathMenus = "../files/menu.txt";
include "../functions/functions.php";

$divStyleResult='block'; // hide div
$categories = file("../files/categories.txt");
$dish = findLine($filePathMenus,$id);

$message = "";
$allDoc =file($filePathMenus);

if (!is_null(filter_input(INPUT_GET, "save"))) {
    
    //variables
    $id = filter_input(INPUT_GET, 'id');
    $category = trim((string)filter_input(INPUT_GET, 'category'));
    $dish = filter_input(INPUT_GET, 'dish');
    $price = filter_input(INPUT_GET, 'price', FILTER_VALIDATE_FLOAT);

    //validate 
    if ($price != false) {
        $modifiedDish = array ($id, $category, $dish, $price);
        if ($result = editFile($modifiedDish, $allDoc)) {
            
            if ($r = saveChangesToFile($filePathMenus, $allDoc)) {
                $divStyleResult='none'; // hide div
                $message = "Changes successfully changed";
            }
        }
    } else{
            $message = "Wrong value introduced for price";
        }

}
if (!is_null(filter_input(INPUT_GET, "delete"))) {
    //id to delete
    $id = filter_input(INPUT_GET, 'id');
    global $allDoc;
    $dish = findLine($filePathMenus,$id);
    $d = implode(";", $dish);

    if (($key = array_search($d, $allDoc)) !== false) {
        unset($allDoc[$key]);
        if ($r = saveChangesToFile($filePathMenus, $allDoc)) {
            $divStyleResult='none'; // hide div
            $message = "Dish successfully deleted";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body background="../images/mesas.jpg">
<?php include_once "topMenu.php"; ?>
    <div class="container ">
        <div class="card mt-5" style="width: 100%;">
        <div class="card-header text-center"><h4>Modify dish</h4></div>
            <div class="card-body">
                <form name="modify-form" method="get" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"style="display: <?= $divStyleResult?>">
                    <div class="form-group row">
                        <label for="id" class="col-sm-2 col-form-label">Id: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="id" value = "<?php echo $id; ?>" readonly >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="col-sm-2 col-form-label">Category: </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="category">
                                <?php selectCategories($categories, $dish[1]) ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dish" class="col-sm-2 col-form-label">Dish: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="dish" value = "<?php echo $dish[2]; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label">Price: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="price" value = "<?php  echo $dish[3]; ?>"required>
                        </div>
                    </div>
                    <div class="form-group row justify-content-between">
                        <div class="col-10">
                            <button type="submit" class="btn btn-success" name="save">Save changes</button>
                            <button onclick="return confirm('Are you sure you want to delete?')"  class="btn btn-danger" name="delete">Delete Dish</button>
                        </div>
                        <div class="col-1 mr-3">
                            <button type="button" class="btn btn-secondary"><a href ="adminMenus.php" style="color: white; text-decoration: none">Cancel</a></button>  
                        </div>
                    </div>
                    
                </form>
                <div ><?php echo $message ?></div>
            </div>
        </div> 
    </div>
</body>
<?php include "footer.php";?>
</html>