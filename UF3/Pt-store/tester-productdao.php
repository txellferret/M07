<?php
echo "<h2>Tester Product</h2>";
require_once "model/persist/ProductDao.php";
require_once "model/Product.php";

use proven\store\model\persist\ProductDao;
use proven\store\model\Product;

$dao = new ProductDao();
//print_r($dao->selectAll());
//print_r($dao->select(new Product(1)));
var_dump($dao->selectByCategory(5));
//print_r($dao->insert(new Product(0, "code00", "desc0")));
//print_r($dao->update(new Product(6, "codeNew", "descNew")));
//print_r($dao->delete(new Product(6)));
