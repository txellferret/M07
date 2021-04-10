<?php
namespace proven\lib;
require_once 'model/Category.php';

use proven\store\model\Category as Category;

/**
 * Description of CategoryFormValidation
 * Provides validation to get data from category form.
 * @author txellfe
 */
class CategoryFormValidation {
    
    /**
     * validates and gets data from category form.
     * @return category the category with the given data or null if data is not present and valid.
     */
    public static function getData() {
        $categoryObj = null;

        $code = "";
        if (filter_has_var(INPUT_POST, 'code')) {
            $code = filter_input(INPUT_POST, 'code'); 
        }
        $description = "";
        if (filter_has_var(INPUT_POST, 'description')) {
            $description = filter_input(INPUT_POST, 'description'); 
        }
       
        $categoryObj = new Category(0, $code, $description);
            
     
        return $categoryObj;
    }
    
}