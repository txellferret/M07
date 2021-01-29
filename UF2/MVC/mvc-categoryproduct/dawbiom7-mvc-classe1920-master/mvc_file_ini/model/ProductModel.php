<?php
require_once "model/ModelInterface.class.php";
require_once "model/persist/ProductFileDAO.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductModel
 *
 * @author tarda
 */
class ProductModel implements ModelInterface {
    
    private $dataProduct;
    
    public function __construct() {
        $this->dataProduct = ProductFileDAO::getInstance();
        
    }

    
    public function add($object): bool {
        
    }

    public function delete($id): bool {
        
    }

    public function listAll(): array {
        return $this->dataProduct->listAll();       
    }

    public function modify($object): bool {
        
    }

    public function searchById($id) {
        
    }

    public function categoryInProduct($idCategory):bool {
        $result=$this->dataProduct->categoryInProduct($idCategory);
                
        return $result;
    } 
    
}
