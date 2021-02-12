<?php
    require_once 'lib/ViewLoader.php';
    require_once 'model/Model.php';
    /**
     * Main controller for store application.
     *
     * @author ProvenSoft
     */
    class MainController {
        /**
         * @var Model $model. The model to provide data services. 
         */
        private  $model;
        /**
         * @var ViewLoader $view. The loader to forward views. 
         */
        private  $view;
        /**
         * @var string $action. The action requested by client. 
         */
        private  $action;
     
        public function __construct() {
            //instantiate the view loader.
            $this->view = new ViewLoader();
            //instantiate the model.
            $this->model = new Model();
        }
     
        /**
         * processes requests made by client.
         */
        public function processRequest() {
            $requestMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
            switch ($requestMethod) {
                case 'GET':
                case 'get':
                    $this->processGet();
                    break;
                case 'POST':
                case 'post':
                    $this->processPost();
                    break;
                default:
                    $this->processError();
                    break;
            }
        } 
     
        /**
         * processes get request made by client.
         */
        private function processGet() {
            $this->action = "";
            if (filter_has_var(INPUT_GET, 'action')) {
                $this->action = filter_input(INPUT_GET, 'action'); 
            }
            switch ($this->action) {
                case 'home':  //home page.
                    $this->doHomePage();
                    break;
                case 'product/listAll': //list all products.
                    $this->doListAllProducts();
                    break;
                case 'user/listAll':
                    $this->doListAllUsers();   //list all users.
                    break;
                case 'product/form':
                    $this->doProductForm();   //show product form.
                    break;
                case 'user/form':
                    $this->doUserForm();   //show user form.
                    break;  
                case 'login':   //login user.
                    var_dump('h');
                    $this->doPageLogin();   
                    break;          
                default:  //processing default action.
                    $this->doHomePage();
                    break;
            }
        }
     
        /**
         * processes post request made by client.
         */
        private function processPost() {
            $this->action = "";
            if (filter_has_var(INPUT_POST, 'submit')) {
                $this->doLogin();
            }
            if (filter_has_var(INPUT_POST, 'action')) {
                $this->action = filter_input(INPUT_POST, 'action'); 
            }
            switch ($this->action) {
                case 'home':  //home page.
                    $this->doHomePage();
                    break;
                case 'product/add':   //add product.
                    $this->doAddProduct();
                    break;
                case 'product/modify':   //modify product.
                    $this->doModifyProduct(); 
                    break;
                case 'product/remove':   //remove product.
                    $this->doRemoveProduct();   
                    break;
                case 'user/add': //add user.
                    $this->doAddUser();
                    break;
                case 'user/modify':   //modify user.
                    $this->doModifyUser();   
                    break;
                case 'user/remove':   //remove user.
                    $this->doRemoveUser();   
                    break;
                default:  //processing default action.
                    $this->doHomePage();
                    break;
            }        
        }    
     
        /**
         * processes error.
         */
        private function processError() {
            trigger_error("Bad method", E_USER_NOTICE);
        }      
     
        /**
         * displays home page content.
         */
        private function doHomePage() {
            $this->view->show("home.php", null);
        }    
     
        /**
         * gets all users and displays them in a proper way.
         */
        private function doListAllUsers() {
            $userList = $this->model->searchAllUsers();
            if (!is_null($userList)) {
                $data["userList"] = $userList;
                $this->view->show("list-users.php", $data);
            }
        }

        private function doListAllProducts() {
            $productList = $this->model->searchAllProducts();
            if (!is_null($productList)) {
                $data["productList"] = $productList;
                $this->view->show("list-products.php", $data);
            }
        }

        function doAddUser() {
            
        }

        function doLogin() {
            if (!is_null(filter_input(INPUT_POST,'submit'))) {
                //variables
                $usernameInput = filter_input(INPUT_POST, "username");
                $passwordInput = filter_input(INPUT_POST, "password");

                $data = $this->model->loginUser($usernameInput,$passwordInput);
                var_dump($data);
                if (!is_null($data)) {
                    $_SESSION["userRole"] = $data;
                    var_dump($_SESSION);
                    header("Location: index.php" );
                } else {
                    $data["errorLogin"] = "Not valid credentials";
                    $this->view->show("login.php", $data);
                }
               
            }

        }

        function doPageLogin(){
            $this->view->show("login.php");
        }

        
     
    }

