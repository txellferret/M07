<?php

require_once "controller/ControllerInterface.php";
require_once "view/ProductView.php";
require_once "model/ProductModel.php";
require_once "util/ProductMessage.php";

/**
 * Description of ProductController
 *
 * @author tarda
 */
class ProductController implements ControllerInterface {

    private $view;
    private $model;

    function __construct() {
        $this->view = new ProductView();
        $this->model = new ProductModel();
    }

    public function processRequest() {

        $request = NULL;
        $_SESSION['info'] = array();
        $_SESSION['error'] = array();

        $request = filter_has_var(INPUT_GET, 'option') ? filter_input(INPUT_GET, 'option') : NULL;
        //print("Entry Product processRequest");
        switch ($request) {
            case "list_all":
                $this->listAll();
                break;
            default:
                $this->view->display();
        }
    }

    public function add() {
        
    }

    public function delete() {
        
    }

    public function listAll() {

        $products = $this->model->listAll();

        if (!empty($products)) {
            $_SESSION['info'] = ProductMessage::INF_FORM['found'];
        } else {
            $_SESSION['error'] = ProductMessage::ERR_FORM['not_found'];
        }

        $this->view->display("view/form/ProductList.php", $products);
    }

    public function modify() {
        
    }

    public function searchById() {
        
    }

}
