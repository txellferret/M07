<?php
    require_once 'lib/ViewLoader.php';
    require_once 'model/Model.php';
    require_once 'lib/ProductFormValidation.php';
    require_once 'lib/UserFormValidation.php';

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
                    $this->doPageLogin();   
                    break;
                case 'logout':   //logout user.
                    $this->doPageLogout();   
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
            if (filter_has_var(INPUT_POST, 'action')) {
                $this->action = filter_input(INPUT_POST, 'action'); 
            }
            switch ($this->action) {
                case 'home':  //home page.
                    $this->doHomePage();
                    break;
                case 'product/find'://add product.
                    $this->doFindProduct();
                    break;
                case 'product/add':   //add product.
                    $this->doAddProduct();
                    break;
                case 'product/modify':   //modify product.
                    $this->doModifyProduct(); 
                    break;
                case 'user/find':
                    $this->doFindUser();
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
                case 'userLogin':
                    $this->doLogin();
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
            //show the template with the given data.
            $this->view->show("user-form.php", $data);           
        }


        function doRemoveUser(){
            $u = UserFormValidation::getData();
            $result = null;
            if ($u === null) {
                $result = "Error reading user";
            }else {
                $result = $this->model->removeUser($u);
                if($result) {
                    $data['result'] = 'User successfully removed';
                    $this->view->show("user-form.php", $data);
                } else {
                    $data['result'] = "Error removing user";
                    $this->view->show("user-form.php", $data);
                }
            }

        }

        function doLogin() {
                //variables
                $usernameInput = filter_input(INPUT_POST, "username");
                $passwordInput = filter_input(INPUT_POST, "password");

                $data = $this->model->loginUser($usernameInput,$passwordInput);
                
                if (!is_null($data)) {
                    
                    $_SESSION['userRole'] = $data;
                    header("Location:index.php");  //redirect to application page
                    exit;
                    
                } else {
                    $data["errorLogin"] = "Not valid credentials";
                    $this->view->show("login.php", $data);
                }
               
        }

        function doPageLogin(){
            $this->view->show("login.php");
        }

        function doPageLogout(){
            $this->view->show("logout.php");
        }

        function doUSerForm(){
            //$product = ProductFormValidation::getData();
            //$data['product']= $product;
            $data['action']= $this->action;
            $this->view->show("user-form.php", $data);
            
        }

        function doProductForm(){
            //$product = ProductFormValidation::getData();
            //$data['product']= $product;
            $data['action']= $this->action;
            $this->view->show("product-form.php", $data);
            
        }

        function doFindUser(){
            $u = UserFormValidation::getData();
            $result = null;
            if ($u === null) {
                $result = "Error reading product";
            } else {
                $userFound = $this->model->searchUser($u->getId());
                if (!is_null($userFound[0])) {
                    //pass data to template.
                    $data['user'] = $userFound[0];
                    $data['action'] = "change";
                } else {
                    $result = "Product not found";
                }            
            }
            //pass data to template.
            $data['result'] = $result;
            //show the template with the given data.
            $this->view->show("user-form.php", $data);  
            
        }

        function doFindProduct() {
            $p = ProductFormValidation::getData();
            $result = null;
            if ($p === null) {
                $result = "Error reading product";
            } else {
                $productFound = $this->model->searchProduct($p->getId());
                if (!is_null($productFound[0])) {
                    //pass data to template.
                    $data['product'] = $productFound[0];
                    $data['action'] = "change";
                } else {
                    $result = "Product not found";
                }            
            }
            //pass data to template.
            $data['result'] = $result;
            //show the template with the given data.
            $this->view->show("product-form.php", $data);  
            
        }


        function doAddProduct() {
            $p = ProductFormValidation::getData();
            $result = null;
            if ($p === null) {
                $result = "Error reading item";
            } else {
                $result = $this->model->addProduct($p);
                if (!$result) {
                    $result = "Item successfully added";
                } else {
                    $result = "Error adding item";
                }            
            }
            //pass data to template.
            $data['result'] = $result;
            //show the template with the given data.
            $this->view->show("product-form.php", $data);  
        }

        function doRemoveProduct() {
            $p = ProductFormValidation::getData();
            $result = null;
            if ($p === null) {
                $result = "Error reading item";
            }else {
                $result = $this->model->removeProduct($p);
                if($result) {
                    $data['result'] = 'Product successfully removed';
                    $this->view->show("product-form.php", $data);
                } else {
                    $data['result'] = "Error removing product";
                    $this->view->show("product-form.php", $data);
                }
            }

        }


        function doModifyProduct() {
            $p = ProductFormValidation::getData();
            $result = null;
            if ($p === null) {
                $result = "Error reading product";
            }else {
                $result = $this->model->modifyProduct($p);
                if($result) {
                    $data['result'] = 'Product successfully modified';
                    $this->view->show("product-form.php", $data);
                } else {
                    $data['result'] = "Error modifing product";
                    $this->view->show("product-form.php", $data);
                }
            }
        }


        function doModifyUser(){
            $u = UserFormValidation::getData();
            $result = null;
            if ($u === null) {
                $result = "Error reading user";
            }else {
                $result = $this->model->modifyUser($u);
                if($result) {
                    $data['result'] = 'User successfully modified';
                    $this->view->show("user-form.php", $data);
                } else {
                    $data['result'] = "Error modifing user";
                    $this->view->show("user-form.php", $data);
                }
            }
        }

        
     
    }

