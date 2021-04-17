<?php

namespace proven\store\model\persist;

require_once 'model/persist/StoreDb.php';
require_once 'model/Category.php';

use proven\store\model\persist\StoreDb as DbConnect;
use proven\store\model\Category as Category;

/**
 * Category database persistence class.
 * @author txellfe
 */
class CategoryDao {

    /**
     * Encapsulates connection data to database.
     */
    private DbConnect $dbConnect;
    /**
     * table name for entity.
     */
    private static string $TABLE_NAME = 'categories';
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
        $this->queries['SELECT_WHERE_CODE'] = \sprintf(
            "select * from %s where code = :code", 
            self::$TABLE_NAME
        );
        $this->queries['INSERT'] = \sprintf(
                "insert into %s (code, description) values (:code, :description)", 
                self::$TABLE_NAME
        );
        $this->queries['UPDATE'] = \sprintf(
                "update %s set code = :code, description = :description where id = :id", 
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
    private function fetchToEntity($statement): mixed {
        $row = $statement->fetch();
        if ($row) {
            $id = $row['id'];
            $code = $row['code'];
            $description = $row['description'];
            return new Category($id, $code, $description);
        } else {
            return false;
        }
    }    
    
    /**
     * selects an entity given its id.
     * @param entity the entity to search.
     * @return entity object being searched or null if not found or in case of error.
     */
    public function select(int $id): ?Category {
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
                    if ($c = $this->fetchToEntity($stmt)){
                        $data = $c;
                    }
                } else {
                    $data = null;
                }
            } else {
                $data = null;
            }

        } catch (\PDOException $e) {
            print "Error Code <br>".$e->getCode();
            print "Error Message <br>".$e->getMessage();
            print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $data = null;
        }   
        return $data;
    }

    /**
     * selects all entitites in database.
     * @return array of entity objects.
     */
    public function selectAll(): array {
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
                    // get one row at the time
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
            print "Error Code <br>".$e->getCode();
            print "Error Message <br>".$e->getMessage();
            print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $data = array();
        }   
        return $data;   
    }

    /**
     * inserts a new entity in database.
     * @param entity the entity object to insert.
     * @return number of rows affected.
     */
    public function insert(Category $entity): int {
        $numAffected = 0;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['INSERT']);
            $stmt->bindValue(":code", $entity->getCode(), \PDO::PARAM_STR); 
            $stmt->bindValue(":description", $entity->getDescription(), \PDO::PARAM_STR);

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
            print "Error Code <br>".$e->getCode();
            print "Error Message <br>".$e->getMessage();
            print "Strack Trace <br>".nl2br($e->getTraceAsString());
        }   

        return $numAffected;
    }

    /**
     * updates entity in database.
     * @param entity the entity object to update.
     * @return number of rows affected.
     */
    public function update(Category $entity): int {
        $numAffected = 0;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['UPDATE']);
            $stmt->bindValue(':code', $entity->getCode(), \PDO::PARAM_STR);
            $stmt->bindValue(':description', $entity->getDescription(), \PDO::PARAM_STR);
            $stmt->bindValue(':id', $entity->getId(), \PDO::PARAM_INT);
            //query execution.
            $success = $stmt->execute(); //bool
            $numAffected = $success ? $stmt->rowCount() : 0;

        } catch (\PDOException $e) {
            //remove in production
            print "Error Code <br>".$e->getCode();
            print "Error Message <br>".$e->getMessage();
            print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $numAffected = 0;
        }
        return $numAffected;  
    }

    /**
     * deletes entity from database.
     * @param id the id object to delete.
     * @return number of rows affected.
     */
    public function delete($id) : int {
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
            /*
            print "Error Code <br>".$e->getCode();
            print "Error Message <br>".$e->getMessage();
            print "Strack Trace <br>".nl2br($e->getTraceAsString());
            */
            return $numAffected;
        }   

        return $numAffected;
            
           
    }    
    
}
