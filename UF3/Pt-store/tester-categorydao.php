<?php
echo "<h2>Tester User</h2>";
require_once "model/persist/CategoryDao.php";
require_once "model/Category.php";

use proven\store\model\persist\CategoryDao;
use proven\store\model\Category;

$dao = new CategoryDao();

echo "Select all: <br>";
print_r($dao->selectAll());
echo "<br><br>Select category id=1: <br>";
print_r($dao->select(1));
echo "<br><br>Insert category: <br>";
print_r($dao->insert(new Category(0, "code0000", "desc0")));
echo "<br><br>Modify category: <br>";
print_r($dao->update(new Category(1, "codeNeww", "descNew")));
echo "<br><br>Delete category: <br>";
print_r($dao->delete(6));

echo "<br><br>Delete category with products in it: <br>";
print_r($dao->delete(1));