<?php

require_once "persist/UserFileDao.php";
/**
 * Model for user application.
 * 
 * @author txellfe
 */

class Model {

    public function _construct() {
    }

    /**
     * searches all users in database.
     * @return array with all users found or null in case of error.
     */
    public function searchAllUsers(): ?array {
        $data = null;
        $dao = new UserFileDao();
        $data = $dao->selectAll();
        return $data;
    }

    function addUser(User $user) {
        $data = false;
        $dao = new UserFileDao();
        $data = $dao->insertUser($user);
        return $data;

    }

    /**
     * checks if user is can log in
     * @param user username entered by user
     * @param pass the password entered by user
     * @return an associative array with roleuser and username 
     */
    public function loginUser($user, $pass){
        $data = array();
        $dao = new UserFileDao();
        $user = $dao->selectWhere(0,$user);
        if (!empty($user)){
            //data is an user
            //get password
            if ($user[0] -> getPassword()== $pass){
                if($user[0] -> isActive()){
                    $data['role'] = $user[0] -> getRole();
                    $data['username'] = $user[0] -> getUsername();
                }
               


            }
            
        }
        
        return $data;


    }
/**
 * Search a user 
 * @param username of the user to search
 * @return the user found or null otherwise
 */
    public function searchUser($username) {
        $data = null;
        $dao = new UserFileDao();
        $data = $dao->selectWhere(0,$username);
        
        return $data;

    }

}