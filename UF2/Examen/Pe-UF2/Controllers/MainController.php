<?php
    require_once 'lib/ViewLoader.php';
    require_once 'model/model.php';
    require_once 'lib/UserFormValidation.php';

    /**
     * Main controller for store application.
     *
     * @author txellfe
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
                case 'user/listAll':
                    $this->doListAllUsers();   //list all users.
                    break;
                case 'user/form-add':
                    $this->doUserAddForm();   //show user form to add.
                    break; 
                case 'user/form':
                    $this->doUserForm();   //show user form to add.
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
                case 'user/find':
                    $this->doFindUser();
                    break;
                case 'user/add': //add user.
                    $this->doAddUser();
                    break;
                case 'user/modify':   //modify user.
                    //$this->doModifyUser();   
                    break;
                case 'user/remove':   //remove user.
                    //$this->doRemoveUser();   
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
                $data['count'] = count($userList);
                $this->view->show("list-users.php", $data);
            }
        }


        function doUserAddForm(){
            $data['action']= $this->action;
            $this->view->show("user-add-form.php", $data);
            
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
            $this->view->show("user-add-form.php", $data);           
        }

        function doUSerForm(){
            $data['action']= $this->action;
            $this->view->show("user-form.php", $data);
            
        }

        function doFindUser(){
            $result = null;
            if(isset($_SESSION['userRole'])){
                $u = UserFormValidation::getData();
                
                if ($u === null) {
                    $result = "Error reading user";
                } else {
                    $userFound = $this->model->searchUser($u->getUsername());
                    if (!is_null($userFound[0])) {
                        //pass data to template.
                        $data['user'] = $userFound[0];
                        $data['action'] = "change";
                    } else {
                        $result = "User not found";
                    }            
                }
            } else {
                $result = "Not allowed";
            }
           
            //pass data to template.
            $data['result'] = $result;
            //show the template with the given data.
            $this->view->show("user-form.php", $data);  
            
        }


        function doLogin() {
            //variables
            $usernameInput = filter_input(INPUT_POST, "username");
            $passwordInput = filter_input(INPUT_POST, "password");

            $data = $this->model->loginUser($usernameInput,$passwordInput);
            
            if (!empty($data)) {
                
                $_SESSION['userRole'] = $data['role'];
                $_SESSION['username'] = $data['username'];
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
     
       
  

        
     
    }
