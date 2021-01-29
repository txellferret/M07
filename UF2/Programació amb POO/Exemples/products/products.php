<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inheritance example</title>
    </head>
    <body>
<?php
require_once 'classes/product.class.php';
require_once 'classes/tv.class.php';
require_once 'classes/fridge.class.php';
use products\Product, products\Tv, products\Fridge;

// methods

/**
 * prints information about a product
 * @param Product product
 */
function printProductInfo(Product $product) {
    echo "<li>" , $product , "</li>";
}

/**
 * prints a list of products
 * @param Product $list
 */
function printProducts(array $list) {
    echo "<p>Printing ", count($list), " elements</p>";
    echo "<ul>";
    foreach ($list as $elem) {
        printProductInfo($elem);
    }
    echo "</ul>";
}

//define a list of shapes.
$myProducts = array();
//populate the list with new shapes.
$myProducts[] = new Tv("TV1", "Television 1", 101.0, 50); 
$myProducts[] = new Fridge("FR1", "Fridge 1", 102.0, 200);//php calcula quin index li toca, no se sobreescriu
//print products information.
printProducts($myProducts);
?>
    </body>
</html>
