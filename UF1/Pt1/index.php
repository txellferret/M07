<?php
session_start();
print_r($_SESSION);

if (isset($_SESSION['userRole'])) {
    $role = $_SESSION["userRole"];
    $username = $_SESSION["userName"];
    $menu = buildMenu($role);
    
} else {
    echo "visitor";
    $menu = buildMenu("visitor");
    
}



function buildMenu(string $roleUser) :string{
    $menu ="";

    $menu .="<a class=\"nav-link active\" href=\"#\">Home <span class=\"sr-only\">(current)</span></a>";
    $menu .="<a class=\"nav-link\" href=\"./pages/dayMenu.php\">Day Menu</a>";
    
    if ($roleUser !== "visitor") {
        $menu .="<a class=\"nav-link\" href=\"./pages/viewMenus.php\">View Menus</a>";
    }
    if (($roleUser == "staff") || ($roleUser == "admin")){
        $menu .="<a class=\"nav-link\" href=\"./pages/adminMenus.php\">Admin Menus</a>";
    }
    if ($roleUser === "admin") {
        $menu .="<a class=\"nav-link\" href=\"./pages/adminUsers.php\">Admin Users</a>";
    }
    if ($roleUser === "visitor") {
        $menu .="<a class=\"nav-link\" href=\"./pages/signIn.php\">Register</a>";
        $menu .="<a class=\"nav-link\" href=\"./pages/login.php\">Login</a>";
    }
    if ($roleUser !== "visitor") {
        $menu .="<a class=\"nav-link\" href=\"./pages/logout.php\">Logout</a>";
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
    <link rel="stylesheet" href="./css/main.css">

    <title>Document</title>
</head>
<body background="images/mesas.jpg">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a id="brand" class="navbar-brand" href="#">Italian Restaurant</a>
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
    <div class="container ">
        <br>
        <br>
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2>Welcome to our Restaurant!</h2>
                <img  class ="img-fluid" src="./images/logo.jpg" alt="restaurant-logo">
            </div>
            <div class="col-md-6" >
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates non asperiores ipsa et modi harum odio quasi totam voluptate deserunt maxime, fugiat vel magnam dolorum? Praesentium voluptates, possimus sunt deserunt quisquam id! Placeat cumque nesciunt modi quas magnam numquam voluptatum quam minus, impedit dolores quibusdam sapiente eius quod, culpa soluta voluptates provident assumenda illum mollitia adipisci voluptate laboriosam consequuntur ratione sequi! Dolorem beatae, sapiente accusantium veritatis porro ullam quae voluptas minus, fugit officiis, odit inventore doloremque! Earum quae eos fugiat qui quisquam doloribus enim quas vel ad eligendi atque, placeat a saepe dolore ex? Maxime, ullam? Et, aut laborum! Odit.</p>
            </div>
        </div>
    </div>
</body>
    <?php include "./pages/footer.php";?>

</html>
