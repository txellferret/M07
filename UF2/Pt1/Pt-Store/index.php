<?php
session_start();





    ini_set('display_errors', 1); //obliga a php q ens ensenyi tots els errors q es produeixen. 
    ini_set('display_startup_errors', 1);   
    ini_set('error_reporting', E_ALL);

    
   
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Store application</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styles.css"> 
  </head>
  <body>
      <?php
       
if(isset($_REQUEST) && isset($_REQUEST['role'])){
  $role = $_REQUEST['role'];
  session_start();
  $_SESSION['userRole'] =$role;
  var_dump($_SESSION);
}
      //Si volguessim que el menu fos dinamic, hauria de ser un php, no un html.
        include "views/topmenu.php";
      ?>
      <h2>Store application</h2>
      <?php
        //dynamic html content generated here by controller.
        require_once 'Controllers/MainController.php';
        (new MainController())->processRequest();
      ?>
  </body>
</html>