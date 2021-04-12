<?php
namespace proven\lib;
require_once 'model/Product.php';

use proven\store\model\Product as Product;

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

        $code = "";
        if (filter_has_var(INPUT_POST, 'code')) {
            $code = filter_input(INPUT_POST, 'code'); 
        }
        $description = "";
        if (filter_has_var(INPUT_POST, 'description')) {
            $description = filter_input(INPUT_POST, 'description'); 
        }

        $price = 0;
        if (filter_has_var(INPUT_POST, 'price')) {
            $price = filter_input(INPUT_POST, 'price',FILTER_SANITIZE_NUMBER_FLOAT); 
        }
        $stock = 0;
        if (filter_has_var(INPUT_POST, 'stock')) {
            $stock = filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT); 
        }

        $category_id = "";
        //retrieve user sent by client.
        if (filter_has_var(INPUT_POST, 'category_id')) {
            $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT); 
        }


       
        $productObj = new Product(0, $code, $description, $price, $stock, $category_id);
     
        return $productObj;
    }
    
}