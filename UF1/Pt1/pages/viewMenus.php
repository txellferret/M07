<?php
session_start();
if(!isset($_SESSION['loggedin'])) {
    header("Location:login.php");
}

$path = "../files/";
$inputFileMenu = "menu.txt";
$categoriesFile = "categories.txt";

$categories = file($path.$categoriesFile);
$meals = file($path.$inputFileMenu);

/**
 * It presents the list of dishes with its price separated by categories.
 */
function buildCarte() {
    global $categories;
    global $meals;
    for ($i=0; $i < count($categories) ; $i++) { 
        echo "<thead class=\"thead-light\"><tr><th>".$categories[$i]."</th></tr></thead><tbody>";

        for ($j=0; $j < count($meals); $j++) { 
            $lineDish = explode(";", $meals[$j]);

            if (trim($lineDish[1]) == trim($categories[$i])) {
                echo "<tr><td>".$lineDish[2]." ".$lineDish[3]."€</td></tr>";
            }
        }
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
            <div class="card-header text-center"><h4>Carte</h4></div>
            <table class="table text-center">
               <?php buildCarte(); ?>
            </table>
        </div>
        <br>
        <br>
        <br>
    </div>
    <?php include "footer.php";?>
</body>
</html>