<?php
/**
 * Description of ItemPdoDb
 *
 * @author ProvenSoft
 */
class ItemPdoDb { 
    
    private static $dsn;
    private $opt;
    private $connection;
    
    public function __construct() {
        //connection data.
        $host = 'localhost';
        $db = 'itemsdb';
        $user = 'provenusr';
        $pass = 'provenpsw';
        $charset = 'utf8';
        self::$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $this->opt = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false
        ];
        //la barra invertida era perque abans hi havia un namespace, i la \ serveix per indicar q no es de cap namespace
        //PDO object creation.
        $this->connection = new \PDO(self::$dsn, $user, $pass, $this->opt);
    }    
    
    public function getConnection() {
        return $this->connection;
    }
  
}