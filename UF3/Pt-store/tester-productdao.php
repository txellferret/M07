<?php
echo "<h2>Tester Product</h2>";
require_once "model/persist/ProductDao.php";
require_once "model/Product.php";

use proven\store\model\persist\ProductDao;
use proven\store\model\Product;

$dao = new ProductDao();

echo "Select all: <br>";
//print_r($dao->selectAll());
echo "<br><br>Select product id=1: <br>";
//print_r($dao->select(1));
echo "<br><br>Select product by category id =1: <br>";
print_r($dao->selectByCategory(1));
echo "<br><br>Insert product: <br>";
//print_r($dao->insert(new Product(0, "code00", "desc0")));
echo "<br><br>Edit product: <br>";
//print_r($dao->update(new Product(6, "codeNew", "descNew")));
echo "<br><br>Delete product: <br>";
//print_r($dao->delete(6));
