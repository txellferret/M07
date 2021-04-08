<?php
     
    require_once 'UserPdoDb.php';
    require_once 'User.php';
     
    /**
     * User database persistence class.
     
     * @author ProvenSoft
     */
    class UserPdoDbDao {
     
        private  $userDb;
        private static  $TABLE_NAME = 'users';
        private  $queries;
     
        public function __construct() { 
            $this->userDb = new UserPdoDb();
            $this->queries = array();
            $this->initQueries();    
        }
     
        public function select(User $entity) {
            $data = null;
            //TODO  
            return $data;
        }
     
        public function selectAll(): array {
            $data = array();
            try {
                //PDO object creation.
                $connection = $this->userDb->getConnection(); 
                //query preparation.
                $stmt = $connection->prepare($this->queries['SELECT_ALL']);
                //query execution.
                $success = $stmt->execute(); //bool
                //Statement data recovery.
                if ($success) {
                    if ($stmt->rowCount()>0) {
                        //$stmt->setFetchMode(PDO::FETCH_ASSOC);
                        // get one row at the time
                        while ($u = $this->fetchToUser($stmt)){
                            array_push($data, $u);
                        }
                        // $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User");
                        // $data = $stmt->fetchAll(); 
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
            }   
            return $data;   
        }
     
        public function insert(User $entity): int {
            $numAffected = 0;
            try {
                //PDO object creation.
                $connection = $this->userDb->getConnection(); 
                //query preparation.
                $stmt = $connection->prepare($this->queries['INSERT']);
                $stmt->bindValue(":username", $entity->getUsername(), \PDO::PARAM_STR); //ultim paramatre valida que sigui string
                $stmt->bindValue(":password", $entity->getPassword(), \PDO::PARAM_STR);
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
     
        public function update(User $entity): int {
            $numAffected = 0;
            try {
                //PDO object creation.
                $connection = $this->userDb->getConnection(); 
                //query preparation.
                $stmt = $connection->prepare($this->queries['UPDATE']);
                $stmt->bindValue(":username", $entity->getUsername());
                $stmt->bindValue(":password", $entity->getPassword(), \PDO::PARAM_STR);
                $stmt->bindValue(":role", $entity->getRole());
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
     
        public function delete(User $entity): int {
            $numAffected = 0;
            try {
                //PDO object creation.
                $connection = $this->userDb->getConnection(); 
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
            $this->queries['INSERT'] = \sprintf(
                    "insert into %s values (0, :username, :password, :role)", 
                    self::$TABLE_NAME
            );
            $this->queries['UPDATE'] = \sprintf(
                    "update %s set username = :username, password = :password, role= :role where id = :id", 
                    self::$TABLE_NAME
            );
            $this->queries['DELETE'] = \sprintf(
                    "delete from %s where id = :id", 
                    self::$TABLE_NAME
            );              
        }
     
        private function fetchToUser($statement) {
            $row = $statement->fetch();
            if ($row) {
                $id = $row['id'];
                $username = $row['username'];
                $password = $row['password'];
                $role = $row['ROLE'];
                return new User($id, $username, $password, $role);
            } else {
                return false;
            }
     
        }
     
    }

