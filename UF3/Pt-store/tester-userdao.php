<?php
echo "<h2>Tester User</h2>";
require_once "model/persist/UserDao.php";
require_once "model/User.php";

use proven\store\model\persist\UserDao;
use proven\store\model\User;

$dao = new UserDao();
//print_r($dao->selectAll());
//print_r($dao->select(1));
//print_r($dao->insert(new User(0, "caca", "txellpass", "txell", "ferret", "registered")));
//print_r($dao->update(new User(6, "txellfe", "ppass11", "peter1", "frampton1", "admin")));
print_r($dao->delete(1));
