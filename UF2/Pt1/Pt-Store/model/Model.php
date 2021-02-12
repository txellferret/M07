<?php

require_once "lib/DaoFactory.php";
/**
 * Model for store application.
 * 
 * @author txellfe
 */

class Model {
    //Es el que dona servei de dades

    public function _construct() {
    }

    /**
     * searches all users in database.
     * @return array with all users found or null in case of error.
     */
    public function searchAllUsers(): ?array {
        $data = null;
        $dao = DaoFactory::getDao("user");
        $data = $dao->selectAll();
        return $data;
    }

    function addUser(User $user) {
        $result = -1;
        $dao = DaoFactory::getDao("user");
        $result= $dao->insert($user);
        return $result;

    }

    /**
     * searches all products in database.
     * @return array with all products found or null in case of error.
     */
    public function searchAllProducts(): ?array {
        $data = null;
        $dao = DaoFactory::getDao("product");
        $data = $dao->selectAll();
        return $data;
    }
    
    /**
     * adds a product to database.
     * @param Product $product the product to add.
     * @return int result code for this operation.
     */
    public function addProduct(Product $product): int {
        $result = -1;
        //TODO
        return $result;
    }
 
    /**
     * modifies a product to database.
     * @param Product $product the product to modify.
     * @return int result code for this operation.
     */    
    public function modifyProduct(Product $product): int {
        $result = -1;
        //TODO
        return $result;
    }
 
    /**
     * removes a product to database.
     * @param Product $product he product to remove.
     * @return int result code for this operation.
     */
    public function removeProduct(Product $product): int {
        $result = -1;
        //TODO
        return $result;
    }

    /**
     * checks if user is can log in
     * @param user username entered by user
     * @param pass the password entered by user
     * @return roleuser or null in case of not allowed
     */
    public function loginUser($user, $pass){
        $data = null;
        $dao = DaoFactory::getDao("user");
        $user = $dao->selectWhere(1,$user);
        if (!empty($user)){
            //data is an user
            //get password
            if ($user[0] -> getPassword()== $pass){
                $data['userRole'] = $user[0] -> getRole();


            }
            
        }
        
        return $data;


    }
 
}