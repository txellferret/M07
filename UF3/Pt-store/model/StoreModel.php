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







    /******************CATEGORIES***************** */

    public function findAllCategories() {
        $dbHelper = new CategoryDao();
        return $dbHelper->selectAll();
    }



    /******************PRODUCTS***************** */

    public function findAllProducts() {
        $dbHelper = new ProductDao();
        return $dbHelper->selectAll();
    }
    
    

}

