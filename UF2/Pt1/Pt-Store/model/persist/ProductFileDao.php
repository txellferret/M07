<?php
require_once "model/Product.php";
/**
 * DAO for product persistance in file
 * 
 * @author txellfe
 */
class ProductFileDAO {

    private  $filename;
    private  $delimiter;
     
    public function __construct() {
        $this->filename = "files/products.txt";
        $this->delimiter = ";";
    
    }

    /**
         * retrieves all products.
         * @return array of products
         */
        //TODO: treat errors and fail conditions (using exceptions, etc.)
        public function selectAll(): ?array {
            $result = array();
            if (($handle = fopen($this->filename, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, $this->delimiter)) !== FALSE) {

                    $product = new Product ($data[0], $data[1], $data[2], $data[3]);
                    array_push($result, $product);
                    
                }
                fclose($handle);
            } else {
                //TODO
            }
        return $result;

        }
    
}