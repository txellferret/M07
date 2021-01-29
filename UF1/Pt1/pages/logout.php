<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!--<!DOCTYPE html>-->
<!--<html>--> 
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<!--<meta charset="UTF-8" />-->
	    <title>Logout</title>
	</head>
	<body>
        <?php
            session_start();
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
	</body>
</html>