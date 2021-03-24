<?php
//parameters to connect to database.
$dsn = 'mysql:host=localhost;dbname=mydb;charset=utf8';  //data source name.
$usr = 'usr';   //user.
$psw = 'psw';   //password.
try {
     //connect to database
     $connection= new PDO($dsn, $usr, $psw);
     $result = $connection->query('SELECT * FROM items'); //query per mostrar info retorna un PDO statement, exect quan diu num de files afectades
     foreach ($result as $row) {
         echo "[" . $row['id']. ' '.$row['item']."]";
     }
     $affectedRows = $connection->exec("INSERT INTO items (item) VALUES ('item 6')");
     echo $affectedRows. " rows affected";
} catch(PDOException $ex) {
    //connect error
    echo "Connection failed: " . $ex->getMessage();
}