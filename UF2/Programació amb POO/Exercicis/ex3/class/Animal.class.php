<?php

namespace speakers;
require "speaker.interface.php";

/**
 * Description of Animal
 * @author txellfe
 */


abstract class Animal implements Speaker {
    private $name;


    public function _construct(string $name) {
        $this->name = $name;
    }

    /**
     * Gets the value of name.
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Sets the value of name.
     * @param string $name the name
     */
    public function setName(string $name) {
        $this->name = $name;
    }


    
    public function _toString() {
        return sprintf("%s{name=%s}", get_class($this), $this->name);
    }


    

    abstract public function talk(); 



    

}
