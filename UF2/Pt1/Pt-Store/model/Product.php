<?php 

/**
* ADT for product. (abstract data type)
* 
* @author txellfe
*/

class Product {

    private $id; //PK
    private $description;
    private $price;
    private $stock;

    public function __construct(int $id, string $description=null, float $price=null, int $stock=null) {
        $this->id = $id;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;

    }

    //getters and setters

    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function getDescription() {
        return $this->description;
    }
    
    public function setDescription($description) {
        $this->description = $description;
    }

    public function getPrice() {
        return $this->price;
    }
    
    public function setPrice($price) {
        $this->price = $price;
    }

    public function getStock() {
        return $this->stock;
    }
    
    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function __toString():string {
        
        $result = "Product {";
        $result .= sprintf("[id=%s]", $this->id);
        $result .= sprintf("[description=%s]", $this->description);
        $result .= sprintf("[price=%s]", $this->price);
        $result .= sprintf("[stock=%s]", $this->stock);
        $result .= "}";

        return $result;
    }

}



