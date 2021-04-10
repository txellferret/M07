<?php
namespace proven\lib;
require_once 'model/User.php';

use proven\store\model\User as User;

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

        $role = "";
        //retrieve user sent by client.
        if (filter_has_var(INPUT_POST, 'role')) {
            $role = filter_input(INPUT_POST, 'role'); 
        }
        $name = "";
        //retrieve user sent by client.
        if (filter_has_var(INPUT_POST, 'name')) {
            $name = filter_input(INPUT_POST, 'name'); 
        }

        $surname = "";
        //retrieve user sent by client.
        if (filter_has_var(INPUT_POST, 'surname')) {
            $surname = filter_input(INPUT_POST, 'surname'); 
        }


       
        $userObj = new User(0, $username, $password, $role, $name, $surname);
            
     
        return $userObj;
    }
    
}