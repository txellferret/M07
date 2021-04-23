<?php
echo "<h2>Tester User</h2>";
require_once "model/persist/UserDao.php";
require_once "model/User.php";

use proven\store\model\persist\UserDao;
use proven\store\model\User;

$dao = new UserDao();
echo "Select all: <br>";
//print_r($dao->selectAll());
echo "<br><br>Select user id=1: <br>";
//print_r($dao->select(1));
echo "<br><br>Insert user: <br>";
//print_r($dao->insert(new User(0, "caca", "txellpass", "txell", "ferret", "registered")));
echo "<br><br>Edit user: <br>";
//print_r($dao->update(new User(6, "txellfe", "ppass11", "peter1", "frampton1", "admin")));
echo "<br><br>Delete user: <br>";
print_r($dao->delete(1));
