<?php
session_start();

if (isset($_SESSION['userRole'])) {
    $role = $_SESSION["userRole"];
    $username = $_SESSION["userName"];
    $menu = buildMenu($role);
    
} else {
    $menu = buildMenu("visitor");
    
}

/**
 * Builds up a menu depending on user role
 * @param role of user
 * @return the menu 
 */
function buildMenu(string $roleUser) :string{
    $menu ="";

    $menu .="<a class=\"nav-link\" href=\"index.php\">Home <span class=\"sr-only\">(current)</span></a>";
    $menu .="<a class=\"nav-link\" href=\"dayMenu.php\">Day Menu</a>";
    
    if ($roleUser !== "visitor") {
        $menu .="<a class=\"nav-link\" href=\"viewMenus.php\">View Menus</a>";
    }
    if (($roleUser == "staff") || ($roleUser == "admin")){
        $menu .="<a class=\"nav-link\" href=\"adminMenus.php\">Admin Menus</a>";
    }
    if ($roleUser === "admin") {
        $menu .="<a class=\"nav-link\" href=\"adminUsers.php\">Admin Users</a>";
    }
    if ($roleUser === "visitor") {
        $menu .="<a class=\"nav-link\" href=\"signIn.php\">Register</a>";
        $menu .="<a class=\"nav-link\" href=\"login.php\">Login</a>";
    }
    if ($roleUser !== "visitor") {
        $menu .="<a class=\"nav-link\" href=\"logout.php\">Logout</a>";
    }
    
    return $menu;
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--css files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">

    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a id="brand" class="navbar-brand" href="index.php">Italian Restaurant</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <?php echo $menu  ?>
            </div>
            <span class="navbar-text ml-5"><?php echo $username?></span>
        </div>
    </nav>
</body>
</html>