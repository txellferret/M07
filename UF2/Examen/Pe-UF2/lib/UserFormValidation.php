<?php
require_once 'model/User.php';

/**
 * Description of UserFormValidation
 * Provides validation to get data from user form.
 * @author txellfe
 */
class UserFormValidation {
    
    /**
     * validates and gets data from user form.
     * @return user the user with the given data or null if data is not present and valid.
     */
    public static function getData() {
        $userObj = null;

        $username = "";
        //retrieve user sent by client.
        if (filter_has_var(INPUT_POST, 'username')) {
            $username = filter_input(INPUT_POST, 'username'); 
        }
        $password = "";
        //retrieve user sent by client.
        if (filter_has_var(INPUT_POST, 'password')) {
            $password = filter_input(INPUT_POST, 'password'); 
        }

        $age = "";
        //retrieve id sent by client.
        if (filter_has_var(INPUT_POST, 'age')) {
            $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT); 
        }

        $role = "";
        //retrieve user sent by client.
        if (filter_has_var(INPUT_POST, 'role')) {
            $role = filter_input(INPUT_POST, 'role'); 
        }

        $active = "";
        //retrieve user sent by client.
        if (filter_has_var(INPUT_POST, 'active')) {
            $active = filter_input(INPUT_POST, 'active', FILTER_VALIDATE_BOOLEAN); 
        }


       if ($username == "" || $password == "" || $age <0 || !$age) {

       } else $userObj = new User($username, $password, intval($age), $role, boolval($active) );
            
     
        return $userObj;
    }
    
}