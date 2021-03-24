<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once 'model/Item.php';
require_once 'ItemDaoInterface.php';
require_once 'ItemPdoDb.php';

/**
 * Item database persistence class.
 * It implements a version of singleton pattern with session storage.
 * @author ProvenSoft
 */
class ItemPdoDbDao implements ItemDaoInterface {

    private static $instance = null;
    private $connection;
    private static $TABLE_NAME = 'items';
    private $queries;
    
    private function __construct() {
        try {
            //PDO object creation.
            $this->connection = (new ItemPdoDb())->getConnection();  
              
            //query definition.
            $this->queries['SELECT_ALL'] = \sprintf(
                    "select * from %s", 
                    self::$TABLE_NAME
            );
            $this->queries['SELECT_WHERE_ID'] = \sprintf(
                    "select * from %s where id = :id", 
                    self::$TABLE_NAME
            );
            $this->queries['INSERT'] = \sprintf(
                    "insert into %s values (0, :title, :content)", 
                    self::$TABLE_NAME
            );
            $this->queries['UPDATE'] = \sprintf(
                    "update %s set title = :title, content = :content where id = :id", 
                    self::$TABLE_NAME
            );
            $this->queries['DELETE'] = \sprintf(
                    "delete from %s where id = :id", 
                    self::$TABLE_NAME
            );   
            
        } catch (PdoException $e) {
            print "Error Code <br>".$e->getCode();
            print "Error Message <br>".$e->getMessage();
            print "Strack Trace <br>".nl2br($e->getTraceAsString());
        }        

    }
 
    /**
     * Singleton implementation of item ADO.
     * perfoms persistance in session.
     * @return DbItemDao the single instance of this object.
     */
    public static function getInstance() {
//        //create instance and test data only if not stored in sessin yet.
//        if (isset($_SESSION['itemDao'])) {
//            self::$instance = $_SESSION['itemDao'];
//        } else {
//            self::$instance = new self();
//            $_SESSION['itemDao'] = self::$instance;
//        }
        if( self::$instance == null ) {
            self::$instance = new self();
        }
        return self::$instance;
    }  
    
    public function select(Item $item) {
        $data = null;
        try {
            $stmt = $this->connection->prepare($this->queries['SELECT_WHERE_ID']);
            $stmt->bindValue(':id', $item->getId(), PDO::PARAM_INT);
            $success = $stmt->execute(); //bool
            if ($success) {
                if ($stmt->rowCount()>0) {
                    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Item');
                    $data = $stmt->fetch();
                } else {
                    $data = null;
                }
            } else {
                $data = null;
            }

        } catch (PDOException $e) {
        }   
        return $data;
    }

    public function selectAll(): array {
        $data = array();
        try {
            $stmt = $this->connection->prepare($this->queries['SELECT_ALL']);
            $success = $stmt->execute(); //bool
            if ($success) {
                if ($stmt->rowCount()>0) {
                    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Item');
                    $data = $stmt->fetchAll(); 
                    //or in one single sentence:
                    //$data = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Item');
                } else {
                    $data = array();
                }
            } else {
                $data = array();
            }
        } catch (PDOException $e) {
            //echo $e->getTraceAsString();
        }   
        return $data;   
    }

    public function insert(Item $item): int {
        $numAffected = 0;
        try {
            $stmt = $this->connection->prepare($this->queries['INSERT']);
            $stmt->bindValue(':title', $item->getTitle(), PDO::PARAM_STR);
            $stmt->bindValue(':content', $item->getContent(), PDO::PARAM_STR);
            $success = $stmt->execute(); //bool
            $numAffected = $success?1:0;
        } catch (PDOException $e) {
            echo $e->getTraceAsString();
            $numAffected = 0;
        }
        return $numAffected;
    }

    public function update(Item $item): int {
        $numAffected = 0;
        try {
            $stmt = $this->connection->prepare($this->queries['UPDATE']);
            $stmt->bindValue(':title', $item->getTitle(), PDO::PARAM_STR);
            $stmt->bindValue(':content', $item->getContent(), PDO::PARAM_STR);
            $stmt->bindValue(':id', $item->getId(), PDO::PARAM_INT);
            $success = $stmt->execute(); //bool
            $numAffected = $success?1:0;
        } catch (PDOException $e) {
            $numAffected = 0;
        }
        return $numAffected;  
    }

    public function delete(Item $item): int {
        $numAffected = 0;
        try {
            $stmt = $this->connection->prepare($this->queries['DELETE']);
            $stmt->bindValue(':id', $item->getId(), PDO::PARAM_INT);
            $success = $stmt->execute(); //bool
            $numAffected = $success?1:0;
        } catch (PDOException $e) {
            $numAffected = 0;
        }
        return $numAffected;        
    }    
    
}