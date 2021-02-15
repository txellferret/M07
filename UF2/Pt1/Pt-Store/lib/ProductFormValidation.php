<?php
require_once 'model/Product.php';

/**
 * Description of ProductFormValidation
 * Provides validation to get data from product form.
 * @author txellfe
 */
class ProductFormValidation {
    
    /**
     * validates and gets data from product form.
     * @return product the product with the given data or null if data is not present and valid.
     */
    public static function getData() {
        $productObj = null;

        $id = "";
        //retrieve id sent by client.
        if (filter_has_var(INPUT_POST, 'id')) {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT); 
        }
        $description = "";
        //retrieve product sent by client.
        if (filter_has_var(INPUT_POST, 'description')) {
            $description = filter_input(INPUT_POST, 'description'); 
        }
        $price = "";
        //retrieve product sent by client.
        if (filter_has_var(INPUT_POST, 'price')) {
            $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT); 
        }

        $stock = "";
        //retrieve product sent by client.
        if (filter_has_var(INPUT_POST, 'stock')) {
            $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT); 
        }


        //if (!empty($id) && !empty($title) && !empty($content)) { 
            //they exists and they are not empty
            $productObj = new Product(intval($id), $description, floatval($price), intval($stock));
            
        //}
        return $productObj;
    }
    
}
