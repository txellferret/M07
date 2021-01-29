<?php

/**
 * Model for store application.
 * 
 * @author txellfe
 */

class Model {
    //Es el que dona servei de dades

    public function _construct() {
        //TODO: create instance of DAOs
    }

    /**
    * Searches all products in database
    * @param
    * @return with all products found or null in case of error. //seria millor llançar una exepcio que la capturaria el controlador
    */
    public function searchAllProducts() : ?array{ //? vol dir que es possible que retorni array o null
        $data = null;
        //TODO
        return $data;
    }


    /**
    * Adds a product to database
    * @param Product $product the product to add
    * @return true if successfully added or false otherwise
    */
    public function addProduct(Product $product) :boolean {
        $result = false;

        return $result;

    }

    /**
    * Modifies a product from database
    * @param Product $product the product to modify
    * @return true if successfully modified or false otherwise
    */
    public function modifyProduct(Product $product) {
        $result = false;

        return $result;

    }
    
    /**
     * 
     */
    public function removeProduct(Product $product) {
        $result = false;

        return $result;

    }

}