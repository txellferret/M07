<?php
    if (isset($_SESSION["userRole"])) {  //user valid
        // destroy everything in this session
        unset($_SESSION);
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"],$params["httponly"]);
        }
            session_destroy();
            echo "<p>Logout done.</p>";
            header("Location:index.php");  //redirect to application page              
        }
        else {  //user not logged yet.
            echo "<p>Not logged!</p>";
            header("Location:index.php");  //redirect to application page        
        }
?>