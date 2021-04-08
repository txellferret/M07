<?php
echo "<h2>Tester User</h2>";
require_once "model/persist/CategoryDao.php";
require_once "model/Category.php";

use proven\store\model\persist\CategoryDao;
use proven\store\model\Category;

$dao = new CategoryDao();
//print_r($dao->selectAll());
//print_r($dao->select(new Category(1)));
//print_r($dao->insert(new Category(0, "code00", "desc0")));
//print_r($dao->update(new Category(6, "codeNew", "descNew")));
//print_r($dao->delete(new Category(6)));
