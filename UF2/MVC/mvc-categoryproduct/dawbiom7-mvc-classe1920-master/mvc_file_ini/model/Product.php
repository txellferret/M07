<?php

/**
 * Description of Product
 *
 * @author tarda
 */
class Product {
    private $id;
    private $name;
    
    public function __construct($id=NULL, $name=NULL) {
        $this->id=$id;
        $this->name=$name;
    }
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    public function __toString() {
        return sprintf("%s;%s\n", $this->id,$this->name);
    }


}