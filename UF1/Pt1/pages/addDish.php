<?php
session_start();
if($_SESSION['userRole'] != "admin" && $_SESSION['userRole'] != "staff" ) {
    header("Location:login.php");
}
$filePathMenus = "../files/menu.txt";
include "../functions/functions.php";

//array of categories available
$categories = file("../files/categories.txt");
$nextId = getNextId($filePathMenus); 


if (!is_null(filter_input(INPUT_GET, "addDish"))) {

    //variables
    $id = filter_input(INPUT_GET, 'id');
    $category = trim((string)filter_input(INPUT_GET, 'category'));
    $dish = filter_input(INPUT_GET, 'dish', FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_GET, 'price', FILTER_VALIDATE_FLOAT);

    //validate 
    if ($price != false) {
        $newDish = array ($id, $category, $dish, $price);
        $lineDish = implode(";", $newDish);

        if (file_put_contents($filePathMenus, $lineDish.PHP_EOL, FILE_APPEND | LOCK_EX)) {
            $message = "Dish successfully added";
            global $nextId;
            $nextId = $id+1;
        }else {
            $message = "Dish UNsuccessfully added";
        }
    } else{
        $message = "Wrong value introduced for price";
    }
}
/**
 * Get next Id for the future dish
 * @param file where dished and their properties are saved
 * @return the next id or 0 if an error ocurred
 */
function getNextId ($filePathMenus) : int{
    $id = 0;
    if ($lines = file("../files/menu.txt")){
        $lastLine = explode(";", $lines[count($lines)-1]);
        $id = $lastLine[0]+1;
    }
    return $id;

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
        <div class="card mt-5 mb-5" style="width: 100%;">
            <div class="card-header text-center"><h4>Add new dish</h4></div>
                <div class="card-body">
                    <form id = "myForm" name="menu-form" method="get" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Id: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="id" value = "<?php echo $nextId; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-sm-2 col-form-label">Category: </label>
                            <div class="col-sm-10">
                                <select class="form-control" name="category">
                                    <?php selectCategories($categories, "none") ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dish" class="col-sm-2 col-form-label">Dish: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="dish" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Price: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="price" required>
                            </div>
                        </div>

                        <div class="form-group row justify-content-between">
                            <div class="col-10">
                                <button type="submit" class="btn btn-success" name ="addDish">Add Dish</button>
                                <button onlick = "clearFields()"  class="btn btn-primary" name ="clear">Clear</button>
                            </div>
                            <div class="col-1 mr-3">
                                <button type="button" class="btn btn-secondary"><a href ="adminMenus.php" style="color: white; text-decoration: none">Cancel</a></button>  
                            </div>
                        </div>
                        <p><?php echo $message?></p>
                    </form>
                </div>
        </div>
    </div>
    <?php include "footer.php";?>
</body>
</html>

<!-- Script to clear fields -->
<script>
    function clearFields() {
        document.getElementById("myForm").reset();
    }
</script>