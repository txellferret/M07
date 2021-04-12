<?php
    session_start();  //initialize session to access session variables.
    //Configuration for debugging (only developing mode). Change for production.
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);   
    ini_set('error_reporting', E_ALL);
    //
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Store manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> 
  </head>
  <body>
      <?php
        include "loadnavbar.php";  //navigation bar.
      ?>
      <?php
        //dynamic html content generated here by controller.
        require_once 'controllers/MainController.php';
        use proven\store\controllers\MainController;
        (new MainController())->processRequest();
      ?>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
</script>      
  </body>
</html>
