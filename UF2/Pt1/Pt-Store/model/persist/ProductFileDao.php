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
    
    public $dataProducts;

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
    

        /**
         * retrieves products with given value in given property.
         * @param $key: the inde of property name
         * @param $value: the value to search.
         * @return array of products with given cryteria.
         */
        //TODO: treat errors and fail conditions (using exceptions, etc.)
        public function selectWhere(int $key, string $value): ?array {
            $result = array();
            $lines = file($this->filename); //each elem is a line
            for ($i=0; $i < count($lines); $i++) { 
                $line = explode(";", $lines[$i]); //line is an array of elements of the line
                if ($line[$key] == $value) {
                    $product = new Product ($line[0], $line[1], $line[2], $line[3]);
                    array_push($result, $product);
                }
            }
        
            return $result;

        }

        /**
         * Inserts a product to database
         * @param p product to add
         * @return true if correctly added or false otherwise
         */
        function insertProduct(Product $p){

            $result = false;
            $fp = fopen($this->filename, 'a');
            //convert obj to array
            $attributes = array($p->getId(), $p->getDescription(), $p->getPrice(), $p->getStock());
            if (!fputcsv($fp, $attributes, ";")) {
                $result = true;
            }
            
            fclose($fp);

            return $result;

        }

         /**
         * Removes a product to database
         * @param p product to remove
         * @return true if correctly removed or false otherwise
         */
        function deleteProduct(Product $p){
            $done =false;
            //get the product
            $p = $this->selectWhere(0, $p->getId());
            if (!empty($p)){
                $attributes = array($p[0]->getId(), $p[0]->getDescription(), $p[0]->getPrice(), $p[0]->getStock());
                $d = implode(";", $attributes);
                
                $allDoc = file($this->filename);
                //trim last space
                $a = array();
                foreach ($allDoc as $v) {
                    array_push($a, trim($v));
                    
                }
                if (($key = array_search($d, $a)) !== false) {
                    unset($allDoc[$key]);

                    $h = fopen($this->filename, "w");
                    if ($h !==false ) {
                        // Guardar los cambios en el archivo:
                        for ($i=0; $i < count($allDoc); $i++) { 
                            trim($allDoc[$i]);
                            fwrite($h, $allDoc[$i]);
                        }
                        $done = true;
                    }
                    fclose($h);

                }
            }
            
            return $done;
        }


        function editProduct(Product $product){
            $done =false;
            $p = $this->selectWhere(0, $product->getId());
            if (!empty($p)){
                $attributes = array($product->getId(), $product->getDescription(), $product->getPrice(), $product->getStock());

                $allDoc = file($this->filename);
                //trim last space
                $a = array();
                foreach ($allDoc as $v) {
                    array_push($a, trim($v));
                    
                }
                for ($i=0; $i < count($a); $i++) { 
                    $line = explode(";",$a[$i]);
                    if($line[0] == $attributes[0]){
                        //transformem line en un string
                        $strinNewLine = implode(";", $attributes);
                        $allDoc[$i] = $strinNewLine.PHP_EOL;
                    break;
                    }
                }
               
                $h = fopen($this->filename, "w");
                    if ($h !==false ) {
                        // Guardar los cambios en el archivo:
                        for ($i=0; $i < count($allDoc); $i++) { 
                            trim($allDoc[$i]);
                            fwrite($h, $allDoc[$i]);
                        }
                        $done = true;
                    }
                    fclose($h);
                $done = true;
            
            
            }



            return $done;
        }
    
}