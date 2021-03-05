
<nav>
    <ul>
        <li><a class = "nav-link" href="index.php?action=home">Home</a></li>
        <li><a class = "nav-link" href="index.php?action=product/listAll">List all products</a></li>
        <li><a class = "nav-link <?php if (!isset($_SESSION['userRole'])) echo 'disabled' ;?>" href="index.php?action=product/form">Product form</a></li>
        <li><a class = "nav-link <?php if (!isset($_SESSION['userRole'])) echo 'disabled' ;?>" href="index.php?action=user/listAll">List all users</a></li>
        <li><a class = "nav-link <?php if (!isset($_SESSION['userRole']) || ($_SESSION['userRole']=='staff')) echo 'disabled' ;?>"href="index.php?action=user/form" >User form</a></li> 
        <li><a class = "nav-link <?php if (isset($_SESSION['userRole']) ) echo 'disabled' ;?>"href="index.php?action=login" >Login</a></li>
        <li><a class = "nav-link <?php if (!isset($_SESSION['userRole']) ) echo 'disabled' ;?>" href="index.php?action=logout">Logout</a></li>
    </ul>
</nav>

