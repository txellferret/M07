<?php
require "./class/Dog.class.php";
require "./class/Cat.class.php";
$dog = new Dog("Bobby");
echo $dog;
echo $dog->talk();

$speakers = array();
//populate array with dog and cat obj TODO

function makeThemTalk(array $speakers){

}

//makeThemTalk($speakers);