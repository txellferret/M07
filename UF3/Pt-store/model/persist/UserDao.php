<?php
namespace proven\store\model\persist;

require_once 'model/persist/StoreDb.php';
require_once 'model/User.php';

use proven\store\model\persist\StoreDb as DbConnect;
use proven\store\model\User as User;

/**
 * User database persistence class.
 * @author txellfe
 */
class UserDao {

    /**
     * Encapsulates connection data to database.
     */
    private DbConnect $dbConnect;
    /**
     * table name for entity.
     */
    private static string $TABLE_NAME = 'users';
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
        $this->queries['SELECT_WHERE_USERNAME'] = \sprintf(
            "select * from %s where username = :username", 
            self::$TABLE_NAME
        );
        $this->queries['SELECT_WHERE_ROLE'] = \sprintf(
            "select * from %s where role = :role", 
            self::$TABLE_NAME
        );
        $this->queries['INSERT'] = \sprintf(
                "insert into %s (username, password, firstname, lastname, role) values (:username, :password, :firstname, :lastname, :role)", 
                self::$TABLE_NAME
        );
        $this->queries['UPDATE'] = \sprintf(
                "update %s set username = :username, password = :password, firstname = :firstname, lastname = :lastname, role= :role where id = :id", 
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
            $username = $row['username'];
            $password = $row['password'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $role = $row['role'];
            return new User($id, $username, $password, $firstname, $lastname, $role);
        } else {
            return false;
        }
    }    
    
    /**
     * selects an entity given its id.
     * @param entity the entity to search.
     * @return entity object being searched or null if not found or in case of error.
     */
    public function select(User $entity): ?User {
        $data = null;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['SELECT_WHERE_ID']);
            $stmt->bindValue(':id', $entity->getId(), \PDO::PARAM_INT);
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
                    // $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'User');
                    // $data = $stmt->fetch();
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
     * selects an entity given its username.
     * @param entity the entity to search.
     * @return entity object being searched or null if not found or in case of error.
     */
    public function selectUserByUsername($username): ?User {
        $data = null;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['SELECT_WHERE_USERNAME']);
            $stmt->bindValue(':username', $username, \PDO::PARAM_STR);
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
                    // $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'User');
                    // $data = $stmt->fetch();
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
                    // get one row at the time, ho converteix a objecte (manualment)
                    while ($u = $this->fetchToEntity($stmt)){
                        array_push($data, $u);
                    }
                    // $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User");
                    // $data = $stmt->fetchAll(); 
                    // la linea de sota hauria de fer automaticament la conversió a obj, pero al profe no li va
                    // //or in one single sentence:
                    //$data = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
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

    public function selectByRole(String $role): array {
        $data = array();
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['SELECT_WHERE_ROLE']);
            $stmt->bindValue(':role', $role, \PDO::PARAM_STR);
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
    public function insert(User $entity): int {
        $numAffected = 0;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['INSERT']);
            $stmt->bindValue(":username", $entity->getUsername(), \PDO::PARAM_STR); //ultim paramatre valida que sigui string
            $stmt->bindValue(":password", $entity->getPassword(), \PDO::PARAM_STR);
            $stmt->bindValue(":firstname", $entity->getFirstName(), \PDO::PARAM_STR);
            $stmt->bindValue(":lastname", $entity->getLastName(), \PDO::PARAM_STR);
            $stmt->bindValue(":role", $entity->getRole(), \PDO::PARAM_STR);

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
    public function update(User $entity): int {
        $numAffected = 0;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['UPDATE']);
            $stmt->bindValue(':username', $entity->getUsername(), \PDO::PARAM_STR);
            $stmt->bindValue(':password', $entity->getPassword(), \PDO::PARAM_STR);
            $stmt->bindValue(':firstname', $entity->getFirstname(), \PDO::PARAM_STR);
            $stmt->bindValue(':lastname', $entity->getLastname(), \PDO::PARAM_STR);
            $stmt->bindValue(':role', $entity->getRole(), \PDO::PARAM_STR);
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
     * @param entity the entity object to delete.
     * @return number of rows affected.
     */
    public function delete(User $entity): int {
        $numAffected = 0;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['DELETE']);
            $stmt->bindValue(":id", $entity->getId());
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
    
}
