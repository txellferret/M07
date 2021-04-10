<?php
namespace proven\store\model;

require_once 'model/persist/UserDao.php';
require_once 'model/User.php';

require_once 'model/persist/CategoryDao.php';
require_once 'model/Category.php';

require_once 'model/persist/ProductDao.php';
require_once 'model/Product.php';


use proven\store\model\persist\UserDao;
use proven\store\model\User;

use proven\store\model\persist\CategoryDao;
use proven\store\model\Category;

use proven\store\model\persist\ProductDao;
use proven\store\model\Product;

/**
 * Service class to provide data.
 * @author txellfe
 */
class StoreModel {


    public function __construct() {
    }

    /******************USERS***************** */
   
    public function findAllUsers(): array {
        $dbHelper = new UserDao();
        return $dbHelper->selectAll();
    }
    
    public function findUsersByRole(string $role): array {
        $dbHelper = new UserDao();
        return $dbHelper->selectByRole($role);
    }

    function addUser(User $user) {
        $data = false;
        $dbHelper = new UserDao();
        $data = $dbHelper->insert($user);
        return $data;

    }







    /******************CATEGORIES***************** */

    public function findAllCategories() {
        $dbHelper = new CategoryDao();
        return $dbHelper->selectAll();
    }

    function addCategory(Category $category) {
        $data = false;
        $dbHelper = new CategoryDao();
        $data = $dbHelper->insert($category);
        return $data;

    }



    /******************PRODUCTS***************** */

    public function findAllProducts() {
        $dbHelper = new ProductDao();
        return $dbHelper->selectAll();
    }

    public function deleteProduct ($id) {
        $data = false;
        $dbHelper = new ProductDao();
        $data = $dbHelper->delete($id);
        return $data;

    }


     /******************SESSION CONTROLS***************** */

    /**
     * checks if user is can log in
     * @param user username entered by user
     * @param pass the password entered by user
     * @return user found or null in case of invalid credentials
     */
    public function loginUser($user, $pass){
        $data = null;
        $dbHelper = new UserDao();
        $result = $dbHelper->selectUserByUsername($user);
        if (!is_null($result)){
            //result is an user
            //get password
            if ($result->getPassword() == $pass){
                $data = $result;
            }
            
        }
        
        return $data;


    }



    
    

}

