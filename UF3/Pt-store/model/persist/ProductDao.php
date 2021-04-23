<?php

namespace proven\store\model\persist;

require_once 'model/persist/StoreDb.php';
require_once 'model/Product.php';

use proven\store\model\persist\StoreDb as DbConnect;
use proven\store\model\Product as Product;

/**
 * Product database persistence class.
 * @author ProvenSoft
 */
class ProductDao {

    /**
     * Encapsulates connection data to database.
     */
    private DbConnect $dbConnect;
    /**
     * table name for entity.
     */
    private static string $TABLE_NAME = 'products';
    /**
     * queries to database.
     */
    private array $queries;
    
    /**
     * constructor.
     */
    public function __construct() { 
        $this->dbConnect = new DbConnect();
        $this->queries = array();
        $this->initQueries();    
    }

    /**
     * defines queries to database.
     */
    private function initQueries() {
        //query definition.
        $this->queries['SELECT_ALL'] = \sprintf(
                "select * from %s", 
                self::$TABLE_NAME
        );
        $this->queries['SELECT_WHERE_ID'] = \sprintf(
                "select * from %s where id = :id", 
                self::$TABLE_NAME
        );
        $this->queries['SELECT_WHERE_CATEGORY'] = \sprintf(
            "select * from %s where category_id = :category_id", 
            self::$TABLE_NAME
        );
        $this->queries['SELECT_WHERE_STOCK_LOWER'] = \sprintf(
            "select * from %s where stock <= :stock", 
            self::$TABLE_NAME
        );
        $this->queries['INSERT'] = \sprintf(
                "insert into %s (code, description, price, stock, category_id) values (:code, :description, :price, :stock, :category_id)", 
                self::$TABLE_NAME
        );
        $this->queries['UPDATE'] = \sprintf(
                "update %s set code = :code, description = :description, price = :price, stock = :stock, category_id= :category_id where id = :id", 
                self::$TABLE_NAME
        );
        $this->queries['DELETE'] = \sprintf(
                "delete from %s where id = :id", 
                self::$TABLE_NAME
        );              
    }

    
    /**
     * fetches a row from PDOStatement and converts it into an entity object.
     * @param $statement the statement with query data.
     * @return entity object with retrieved data or false in case of error.
     */
    private function fetchToEntity($statement) {
        $row = $statement->fetch();
        if ($row) {
            $id = $row['id'];
            $code = $row['code'];
            $description = $row['description'];
            $price = $row['price'];
            $stock = $row['stock'];
            $category_id = $row['category_id'];
            return new Product($id, $code, $description, $price, $stock, $category_id);
        } else {
            return false;
        }
    }    
    
    /**
     * selects an entity given an id.
     * @param entity the entity to search.
     * @param propertySearch the property to look for
     * @return entity object being searched or null if not found or in case of error.
     */
    public function select(int $id) {
        $data = null;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['SELECT_WHERE_ID']);
            $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
            
            //query execution.
            $success = $stmt->execute(); //bool
            //Statement data recovery.
            if ($success) {
                if ($stmt->rowCount()>0) {
                    //set fetch mode.
                    $stmt->setFetchMode(\PDO::FETCH_ASSOC);
                    // get one row at the time
                    if ($u = $this->fetchToEntity($stmt)){
                        $data = $u;
                    }
                } else {
                    $data = null;
                }
            } else {
                $data = null;
            }

        } catch (\PDOException $e) {
            if ($e->getCode() == 1045) {
                return -1;
            }else {
                return $data;
            }
        }   
        return $data;
    }

    /**
     * selects all entitites in database.
     * @return array of entity objects.
     */
    public function selectAll() {
        $data = array();
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['SELECT_ALL']);
            //query execution.
            $success = $stmt->execute(); //bool
            //Statement data recovery.
            if ($success) {
                if ($stmt->rowCount()>0) {
                    //set fetch mode.
                    $stmt->setFetchMode(\PDO::FETCH_ASSOC);
                    // get one row at the time, ho converteix a objecte (manualment)
                    while ($p = $this->fetchToEntity($stmt)){
                        array_push($data, $p);
                    }
                } else {
                    $data = array();
                }
            } else {
                $data = array();
            }
        } catch (\PDOException $e) {
            if ($e->getCode() == 1045) {
                return -1;
            }else {
                return $data;
            }
        }   
        return $data;   
    }
/**
 * Seelcts prodcut given a category id
 * @param category_id the cat to search
 * @return array of products, or -1 if error connection
 */
    public function selectByCategory(int $category_id)  {
        $data = array();
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['SELECT_WHERE_CATEGORY']);
            $stmt->bindValue(':category_id', $category_id, \PDO::PARAM_INT);
            //query execution.
            $success = $stmt->execute(); //bool
            //Statement data recovery.
            if ($success) {
                if ($stmt->rowCount()>0) {
                    //set fetch mode.
                    $stmt->setFetchMode(\PDO::FETCH_ASSOC);
                    // get one row at the time, ho converteix a objecte (manualment)
                    while ($u = $this->fetchToEntity($stmt)){
                        array_push($data, $u);
                    }
                   
                } else {
                    $data = array();
                }
            } else {
                $data = array();
            }
        } catch (\PDOException $e) {
            if ($e->getCode() == 1045) {
                return -1;
            }else {
                return $data;
            }
        }   
        return $data;  
    }

    /**
     * inserts a new entity in database.
     * @param entity the entity object to insert.
     * @return number of rows affected or -1 if error connection
     */
    public function insert(Product $entity) {
        $numAffected = 0;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['INSERT']);
            $stmt->bindValue(":code", $entity->getCode(), \PDO::PARAM_STR); //ultim paramatre valida que sigui string
            $stmt->bindValue(":description", $entity->getDescription(), \PDO::PARAM_STR);
            $stmt->bindValue(":price", $entity->getPrice());
            $stmt->bindValue(":stock", $entity->getStock());
            $stmt->bindValue(":category_id", $entity->getCategoryId(), \PDO::PARAM_INT);

            //query execution.
            $success = $stmt->execute(); //bool

            //Statement data recovery.
            if ($success) {
                if ($stmt->rowCount()>0) {
                    //$stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $numAffected = $stmt->rowCount();
                   
                } 
            } 
        } catch (\PDOException $e) {
            if ($e->getCode() == 1045) {
                return -1;
            }else {
                return $numAffected;
            }
        }   

        return $numAffected;
    }

    /**
     * updates entity in database.
     * @param entity the entity object to update.
     * @return number of rows affected or -1 if error connection
     */
    public function update(Product $entity) {
        $numAffected = 0;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['UPDATE']);
            $stmt->bindValue(':code', $entity->getCode(), \PDO::PARAM_STR);
            $stmt->bindValue(':description', $entity->getDescription(), \PDO::PARAM_STR);
            $stmt->bindValue(':price', $entity->getPrice());
            $stmt->bindValue(':stock', $entity->getStock());
            $stmt->bindValue(':category_id', $entity->getCategoryId(), \PDO::PARAM_INT);
            $stmt->bindValue(':id', $entity->getId(), \PDO::PARAM_INT);
            //query execution.
            $success = $stmt->execute(); //bool
            $numAffected = $success ? $stmt->rowCount() : 0;
        } catch (\PDOException $e) {
            if ($e->getCode() == 1045) {
                return -1;
            }else {
                return $numAffected;
            }
        }
        return $numAffected;  
    }

    /**
     * deletes entity from database.
     * @param entity the entity object to delete.
     * @return number of rows affected or -1 if error connection
     */
    public function delete($id) {
        $numAffected = 0;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['DELETE']);
            $stmt->bindValue(":id", $id);
            //query execution.
            $success = $stmt->execute(); //bool

            //Statement data recovery.
            if ($success) {
                if ($stmt->rowCount()>0) {
                    //$stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $numAffected = $stmt->rowCount();
           
                } 
            } 
        } catch (\PDOException $e) {
            if ($e->getCode() == 1045) {
                return -1;
            }else {
                return $numAffected;
            } 
        }   

        return $numAffected;
            
           
    }    
    
}
