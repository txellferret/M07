<?php

include "users.class.php";

/**
 * Loads and initializes an array with user objects.
 * @return array of users with theis properties
 */
function loadData(): array{
    $users = array();
    array_push ($users, new User("myuserName1", "myPassword1", "registered","myName1", "mySurname1"));
    array_push ($users, new User("myuserName2", "myPassword2", "staff","myName2", "mySurname2"));
    array_push ($users, new User("myuserName3", "myPassword3", "admin","myName3", "mySurname3"));

    return $users;
}


/**
 * Prints user array.
 * @param data data to print
 */
function printUsers (array $data) {
    for ($i=0; $i < count($data); $i++) { 
        echo $data[$i]."<br>";
    }
    
}

//main program 
$listOfUsers = loadData();
printUsers($listOfUsers);