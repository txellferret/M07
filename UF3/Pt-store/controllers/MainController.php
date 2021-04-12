<?php

namespace proven\store\controllers;


require_once 'lib/ViewLoader.php';
require_once 'lib/UserFormValidation.php';
require_once 'lib/CategoryFormValidation.php';
require_once 'lib/ProductFormValidation.php';

require_once 'model/StoreModel.php';
require_once 'model/User.php';
require_once 'model/Category.php';
require_once 'model/Product.php';


use proven\store\model\StoreModel as Model;
use proven\lib\ViewLoader as View;
use proven\lib\UserFormValidation as UserFormValidation;
use proven\lib\CategoryFormValidation as CategoryFormValidation;
use proven\lib\ProductformValidation as ProductformValidation;

/**
 * Main controller
 * @author txellfe
 */
class MainController {

    /* ============== PROPERTIES ============== */

    /**
     * @var ViewLoader
     */
    private $view;
    /**
     * @var Model 
     */
    private $model;
    /**
     * @var string  
     */
    private $action;
    /**
     * @var string  
     */
    private $requestMethod;

    /**
     * constructor.
     */
    public function __construct() {
        //instantiate the view loader.
        $this->view = new View();
        //instantiate the model.
        $this->model = new Model();
    }

    /* ============== HTTP REQUEST METHODS ============== */

    /**
     * processes requests from client, regarding action command.
     */
    public function processRequest() {
        $this->action = "";
        //retrieve action command requested by client.
        if (\filter_has_var(\INPUT_POST, 'action')) {
            $this->action = \filter_input(\INPUT_POST, 'action');
        } else {
            if (\filter_has_var(\INPUT_GET, 'action')) {
                $this->action = \filter_input(\INPUT_GET, 'action');
            } else {
                $this->action = "home";
            }
        }
        //retrieve request method.
        if (\filter_has_var(\INPUT_SERVER, 'REQUEST_METHOD')) {
            $this->requestMethod = \strtolower(\filter_input(\INPUT_SERVER, 'REQUEST_METHOD'));
        }
        //process action according to request method.
        switch ($this->requestMethod) {
            case 'get':
                $this->doGet();
                break;
            case 'post':
                $this->doPost();
                break;
            default:
                $this->handleError();
                break;
        }
    }

    /**
     * processes get requests from client.
     */
    private function doGet() {
        //process action.
        switch ($this->action) {
            case 'home':
                $this->homePage();
                break;
            case 'user':
                $this->userMng();
                break;
            case 'category':
                $this->categoryMng();
                break;
            case 'product':
                $this->productMng();
                break;
            case 'loginform':
                $this->loginForm();
                break;
            case 'logout':   //logout user.
                $this->logoutUser();   
                break;
            default:  //processing default action.
                $this->handleError();
                break;
        }
    }

    /**
     * processes post requests from client.
     */
    private function doPost() {
        //process action.
        switch ($this->action) {
            case 'user/role':
                $this->listUsersByRole();
                break;
            case 'user/add':
                $this->userEditForm("add");
                break;
            case 'addUser':
                $this->addUser();
                break;
            case 'category/add':
                $this->categoryEditForm("add");
                break;
            case 'addCategory': 
                $this->addCategory();
                break;
            case 'category/edit':
                $this->categoryEditForm("edit");
                break;
            case 'editCategory':
                $this->editCategory();
                break;
            case 'product/category':
                $this->listProductsByCategory();
                break;
            case 'deleteProduct':
                $this->deleteProduct();
                break;
            case 'product/add':
                $this->productEditForm("add");
                break;
            case 'product/edit':
                $this->productEditForm("edit");
                break;
            case 'addProduct':
                $this->addProduct();
                break;
            case 'editProduct':
                $this->editProduct();
                break;
            case 'userLogin':
                $this->doLogin();
            break;
            default:  //processing default action.
                $this->homePage();
                break;
        }
    }

    /* ============== NAVIGATION CONTROL METHODS ============== */

    /**
     * handles errors.
     */
    private function handleError() {
        $this->view->show("message.php", ['message' => 'Something went wrong!']);
    }

    /**
     * displays home page content.
     */
    private function homePage() {
        $this->view->show("home.php", []);
    }

    /* ============== SESSION CONTROL METHODS ============== */

    /**
     * displays login form page.
     */
    private function loginForm() {
        $data = null;
        if(isset($_SESSION['nameUser'])){
            $data["alreadyLogged"] = "User already logged in";
        }
        $this->view->show("login/loginform.php", $data);  
    }

    /**
     * Does log out if user logged in.
     */
    private function logoutUser(){
        if(isset($_SESSION['nameUser'])){
            $this->view->show("logout/logout.php");
        } else {
            header("Location:index.php");
        }
        
    }

    /**
     * Do log in to application if crediantials are correct
     * 
     */
    private function doLogin() {
        //variables
        $usernameInput = filter_input(INPUT_POST, "username");
        $passwordInput = filter_input(INPUT_POST, "password");

        $data = $this->model->loginUser($usernameInput,$passwordInput);
                
            if (!is_null($data)) {

                $_SESSION['nameUser'] = $data -> getFirstname()." ".$data -> getLastname();  
                $_SESSION['userRole'] = $data -> getRole();
                header("Location:index.php");  //redirect to application page
                exit;
                    
            } else {
                $data["errorLogin"] = "Not valid credentials";
                $this->view->show("login/loginform.php", $data);
            }


    }

    /* ============== USER MANAGEMENT CONTROL METHODS ============== */

    /**
     * displays user management page.
     */
    private function userMng() {
        //get all users.
        $result = $this->model->findAllUsers();
        //pass list to view and show.
        $this->view->show("user/usermanage.php", ['list' => $result]);        
        //$this->view->show("user/user.php", [])  //initial prototype version;
    }

    /**
     * Lists users given a role.
     */
    private function listUsersByRole() {
        //get role sent from client to search.
        $roletoSearch = \filter_input(INPUT_POST, "role", FILTER_SANITIZE_STRING);
        if ($roletoSearch !== false) {
            //get users with that role.
            $result = $this->model->findUsersByRole($roletoSearch);
            //pass list to view and show.
            $this->view->show("user/usermanage.php", ['list' => $result]);   
        }  else {
            //pass information message to view and show.
            $this->view->show("user/usermanage.php", ['message' => "No data found"]);   
        }
    }


    /**
     * Shows user form
     * @param mode: if form is to add or modify
     */
    private function userEditForm(string $mode) {
        $data['listRoles'] = array("admin", "registered"); //TODO: query to DB
        $data['action'] = $mode;
        $this->view->show("user/userForm.php", $data);  
    }

    /**
     * Adds a user to DB
     */
    private function addUser() {
        $u = UserFormValidation::getData();
            $result = null;
            if ($u === null) {
                $result = "Error reading user";
            } else {
                $result = $this->model->addUser($u);
                if ($result) {
                    $result = "User successfully added";
                } else {
                    $result = "Error adding user";
                }            
            }
            //pass data to template.
            $data['result'] = $result;
            $data['action'] = 'add';
            //show the template with the given data.
            $this->view->show("user/userForm.php", $data);  


    }

   

    /* ============== CATEGORY MANAGEMENT CONTROL METHODS ============== */

    /**
     * displays category management page.
     */
    private function categoryMng() {
        //get all categories.
        $result = $this->model->findAllCategories();
        //pass list to view and show.
        $this->view->show("category/categorymanage.php", ['list' => $result]);
    }

    private function categoryEditForm(string $mode) {
        if ($mode == "edit") {
            $idCat= \filter_input(INPUT_POST, "idCategory", FILTER_SANITIZE_NUMBER_INT);
            $result = $this->model->findCategoryById($idCat);
            if (!is_null($result)) {
                $data['catToModify'] = $result;
            }
        }
        $data['action'] = $mode;
        $this->view->show("category/categoryForm.php", $data);  
    }
    
    private function addCategory() {
        $c = CategoryFormValidation::getData();
        $result = null;
        if ($c === null) {
            $result = "Error reading category";
        } else {
            $result = $this->model->addCategory($c);
            if ($result) {
                $result = "Category successfully added";
            } else {
                $result = "Error adding category";
            }            
        }
        //pass data to template.
        $data['result'] = $result;
        $data['action'] = 'add';
        //show the template with the given data.
        $this->view->show("category/categoryForm.php", $data);  
    }

    private function editCategory() {
        $idCat= \filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
        $c = CategoryFormValidation::getData();
        $c->setId($idCat);

        $result = null;
        if ($c === null) {
            $result = "Error reading category";
        }else {
            $result = $this->model->editCategory($c);
            if ($result) {
                $result = "Category successfully updated";
            } else {
                $result = "Error updating category";
            }        

        }
         //pass data to template.
         $data['result'] = $result;
         $data['action'] = 'edit';
         //show the template with the given data.
         $this->view->show("category/categoryForm.php", $data); 


    }


    /* ============== PRODUCT MANAGEMENT CONTROL METHODS ============== */

    /**
     * displays product management page.
     */
    private function productMng() {
        //get all categories.
        $result = $this->model->findAllProducts();
        //pass list to view and show.
        $this->view->show("product/productmanage.php", ['list' => $result]);
    }

    private function listProductsByCategory() {
        //get category sent from client to search.
        $categorytoSearch = \filter_input(INPUT_POST, "category_id", FILTER_SANITIZE_NUMBER_INT);
        if ($categorytoSearch !== false) {
            //get products with that category.
            $result = $this->model->findProductsByCategory($categorytoSearch);
            //pass list to view and show.
            $this->view->show("product/productmanage.php", ['list' => $result]);   
        }  else {
            //pass information message to view and show.
            $this->view->show("product/productmanage.php", ['message' => "No data found"]);   
        }

    }

    private function deleteProduct() {
        $data = null;
        $id = filter_input(INPUT_POST, 'id'); 
        
        $result = $this->model->deleteProduct($id);
        if ($result) {
            $this->productMng();
        } else {
            $data['result'] = "Error deleting product";
            $this->view->show("product/productmanage.php", $data);
        }  
    }

    private function productEditForm (string $mode) {
        if ($mode == "edit") {
            $idProd = \filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
            $result = $this->model->findProductById($idProd);
            if (!is_null($result)) {
                $data['productToModify'] = $result;
            }
        }
        $data['listCategories'] = array(1, 2, 3, 4, 5); //TODO: query to DB
        $data['action'] = $mode;
        $this->view->show("product/productForm.php", $data);  
    }

    private function addProduct () {
            $p = ProductFormValidation::getData();
            $result = null;
            if ($p === null) {
                $result = "Error reading product";
            } else {
                $result = $this->model->addProduct($p);
                if ($result) {
                    $result = "Product successfully added";
                } else {
                    $result = "Error adding product";
                }            
            }
            //pass data to template.
            $data['result'] = $result;
            $data['action'] = 'add';
            //show the template with the given data.
            $this->view->show("product/productForm.php", $data); 

    }

    private function editProduct() {
        $idProd = \filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
        $p = ProductFormValidation::getData();
        $p->setId($idProd);

        $result = null;
        if ($p === null) {
            $result = "Error reading product";
        }else {
            $result = $this->model->editProduct($p);
            if ($result) {
                $result = "Product successfully updated";
            } else {
                $result = "Error updating product";
            }        

        }
         //pass data to template.
         $data['result'] = $result;
         $data['action'] = 'edit';
         //show the template with the given data.
         $this->view->show("product/productForm.php", $data); 


    }


}
