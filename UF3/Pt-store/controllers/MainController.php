<?php

namespace proven\store\controllers;

//TODO implements all functionalities.

require_once 'lib/ViewLoader.php';
require_once 'model/StoreModel.php';
require_once 'model/User.php';

use proven\store\model\StoreModel as Model;
use proven\lib\ViewLoader as View;

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
            case 'userLogin':
                $this->doLogin();
            break;
            case 'add/userForm':
                $this-> addUserForm();
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

    private function userEditForm(string $mode) {
        $this->view->show("user/userdetail.php", ['message' => $mode]);  //initial prototype version.
    }

    private function addUserForm(){
        $data['listRoles'] = array("admin", "registered"); //TODO: query to DB
        $data['action'] = "add";
        $this->view->show("user/userForm.php", $data);
    }

    /* ============== CATEGORY MANAGEMENT CONTROL METHODS ============== */

    /**
     * displays category management page.
     */
    public function categoryMng() {
        //get all categories.
        $result = $this->model->findAllCategories();
        //pass list to view and show.
        $this->view->show("category/categorymanage.php", ['list' => $result]);
    }

    /* ============== PRODUCT MANAGEMENT CONTROL METHODS ============== */

    /**
     * displays product management page.
     */
    public function productMng() {
        //get all categories.
        $result = $this->model->findAllProducts();
        //pass list to view and show.
        $this->view->show("product/productmanage.php", ['list' => $result]);
    }


}
