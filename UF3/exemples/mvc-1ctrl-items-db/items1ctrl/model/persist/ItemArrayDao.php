<?php
require_once 'ItemDaoInterface.php';

/**
 * Item persistence class.
 * It implements a version of singleton pattern with session storage.
 * @author ProvenSoft
 */
class ItemArrayDao implements ItemDaoInterface {
    
    private static $instance = null;
    public $data;
 
    private function __construct() {
        //create test data.
        $this->data = array();
        array_push($this->data, new Item('1', 'Item 1', 'Content 1'));
        array_push($this->data, new Item('2', 'Item 2', 'Content 2'));
        array_push($this->data, new Item('3', 'Item 3', 'Content 3'));
        array_push($this->data, new Item('4', 'Item 4', 'Content 4'));
        array_push($this->data, new Item('5', 'Item 5', 'Content 5'));
        array_push($this->data, new Item('6', 'Item 6', 'Content 6'));
        array_push($this->data, new Item('7', 'Item 7', 'Content 7'));
        array_push($this->data, new Item('8', 'Item 8', 'Content 8'));
        array_push($this->data, new Item('9', 'Item 9', 'Content 9'));
    }
 
    /**
     * Singleton implementation of item DAO.
     * perfoms persistance in session.
     * @return ArrayItemDao the single instance of this object.
     */
    public static function getInstance() {
        //create instance and test data only if not stored in session yet.
        if (isset($_SESSION['itemDao'])) {
            self::$instance = unserialize($_SESSION['itemDao']);
        } else {
            self::$instance = new self();
            $_SESSION['itemDao'] = serialize(self::$instance);
        }
//        if( self::$instance == null ) {
//            self::$instance = new self();
//        }
        return self::$instance;
    }

    public function getData() {
        return $this->data;
    }
    
    /**
     * retrieves all items from data source.
     * @return Item[]
     */
    public function selectAll() {
        return $this->data;
    }
    
    /**
     * looks for an item in data source
     * @param Item $item item to search
     * @return Item item found or null if not found.
     */
    public function select(Item $item) {
        $found = null;
        foreach ($this->data as $it) {
            if ($it->getId()==$item->getId()) {
                $found = $it;
                break;
            }
        }
        return $found;
    }
    
    /**
     * inserts an item into data source
     * @param Item $item item to insert to data source.
     * @return int number of entries inserted.
     */
    public function insert(Item $item) {
        $affected = 0;   //counter of changes in data source, initially zero.
        //TODO prevent id duplicates.
        array_push($this->data, $item);
        $affected = 1;
        $_SESSION['itemDao'] = serialize(self::$instance);
        return $affected;
    }
    
    /**
     * updates an item in data source
     * @param Item $item item to update in data source.
     * @return int number of entries updated.
     */
    public function update(Item $item) {
        $affected = 0;   //counter of changes in data source, initially zero.
        $index = $this->indexOf($item);
        if ($index >= 0) {
            $this->data[$index] = $item;
            $affected = 1;
            $_SESSION['itemDao'] = serialize(self::$instance);
        } else {
            $affected = 0;
        }
        return $affected;
    }    
    
    /**
     * deletes an item from data source
     * @param Item $item ityem to delete from data source.
     * @return int number of entries deleted.
     */
    public function delete(Item $item) {
        $affected = 0;   //counter of changes in data source, initially zero.
        $index = $this->indexOf($item);
        if ($index >= 0) {
            array_splice($this->data, $index, 1);
            $affected = 1;
            $_SESSION['itemDao'] = serialize(self::$instance);
        } else {
            $affected = 0;
        }
        return $affected;        
    }
    
    /**
     * looks for an item in data source
     * @param Item $item item to search
     * @return int position of item found or -1 if not found
     */
    public function indexOf(Item $item) {
        $found = -1;
        for ($i=0; $i< count($this->data); $i++) {
            $x = $this->data[$i]->getId();
            $y = $item->getId();
            if ($x === $y) {
                $found = $i;
                break;
            }      
        }
        return $found;
    }  
    
}