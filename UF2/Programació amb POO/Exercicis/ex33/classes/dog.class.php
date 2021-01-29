<?php


require_once "animal.class.php";

class Dog extends Animal {

    public function _construct(string $name) {
        parent:: _construct($name);
    }

    public function _toString() {
        return sprintf("%s{name=%s}", get_class($this), $this->name);
    }

    public function talk() {
        echo "Uau";
    }

}