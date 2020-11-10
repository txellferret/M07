<?php

$path = "../files/";
$inputFileDayMenu = "dayMenu.txt";
$categoriesFile = "categories.txt";


$categories = file($path.$categoriesFile);
$dishes = file($path.$inputFileDayMenu);

/**
 * 
 */
function dayMenu() {
    global $categories;
    global $dishes;
    for ($i=0; $i < count($categories) ; $i++) { 
        echo "<ul class= \"list-group list-group-flush\">";
        echo "<li class=\"list-group-item\">"."<h4>".$categories[$i]."</h4>"."</li>"; 
        
        for ($j=0; $j < count($dishes); $j++) { 
            $lineDish = explode(";", $dishes[$j]);

            if (trim($lineDish[1]) == trim($categories[$i])) {
                echo "<li class=\"list-group-item\">".$lineDish[2]."</li>"; 
            }
        }
        echo "</ul>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--css files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Document</title>
</head>
<body background="../images/mesas.jpg">
<?php include_once "topMenu.php"; ?>
    <div class="container ">
        <div class="card mt-5 mb-5" style="width: 100%;">
            <div class="card-header text-center"><h4>Day Menu</h4></div>
            <div class ="text-center"><?php dayMenu();?></div>
        </div>
        <br>
        <br>
        <br>
    </div>
    <?php include "footer.php";?>
</body>
</html>

