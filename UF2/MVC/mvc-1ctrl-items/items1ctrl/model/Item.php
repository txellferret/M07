<?php   
/**
 * Item class definition.
 * @author ProvenSoft
 */
class Item {
    private $id;
    private $title;
    private $content;
    
    public function __construct($id=null, $title=null, $content=null) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }
 
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getTitle() {
        return $this->title;
    }    
    
    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function __toString() {
        return "Item{[id=$this->id][title=$this->title][content=$this->content]}";
    }
    
    public function equals($other) {
        $ret = false;
        if ($other instanceof Item) {
            $ret = ($this->id === $other->id);
        }
        return $ret;
    }
      
}
