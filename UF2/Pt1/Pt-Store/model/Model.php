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
        $data = false;
        $dao = DaoFactory::getDao("user");
        $data = $dao->insertUser($user);
        return $data;

    }

    function removeUser(User $user){
        $data = false;
        $dao = DaoFactory::getDao("user");
        $data = $dao->deleteUser($user);
        
        return $data;

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
     * @return true if correctly done, false otherwise
     */
    public function addProduct(Product $product): int {
        $data = false;
        $dao = DaoFactory::getDao("product");
        $data = $dao->insertProduct($product);
        
        return $data;
    }
 
    /**
     * modifies a product to database.
     * @param Product $product the product to modify.
     * @return true if correctly done, false otherwise
     */    
    public function modifyProduct(Product $product) {
        $data = false;
        $dao = DaoFactory::getDao("product");
        $data = $dao->editProduct($product);
        return $data;
    }
 
    /**
     * removes a product to database.
     * @param Product $product the product to remove.
     * @return true if correctly done, false otherwise
     */
    public function removeProduct(Product $product) {
        $data = false;
        $dao = DaoFactory::getDao("product");
        $data = $dao->deleteProduct($product);
        
        return $data;
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
                $data = $user[0] -> getRole();


            }
            
        }
        
        return $data;


    }

    public function searchProduct($id) {
        $data = null;
        $dao = DaoFactory::getDao("product");
        $data = $dao->selectWhere(0,$id);
        
        return $data;
    }


    public function searchUser($id) {
        $data = null;
        $dao = DaoFactory::getDao("user");
        $data = $dao->selectWhere(0,$id);
        
        return $data;

    }



    /**
     * modifies a user to database.
     * @param USer $user the user to modify.
     * @return true if correctly done, false otherwise
     */    
    public function modifyUser(User $user) {
        $data = false;
        $dao = DaoFactory::getDao("user");
        $data = $dao->editUser($user);
        return $data;
    }

 
}