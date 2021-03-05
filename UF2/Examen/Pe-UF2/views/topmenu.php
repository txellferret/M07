
<nav>
    <ul>
        <li><a class = "nav-link" href="index.php?action=home">Home</a></li>
        <li><a class = "nav-link" href="index.php?action=user/listAll">List users</a></li>
        <li><a class = "nav-link"href="index.php?action=user/form-add" >Add user</a></li> 
        <li><a class = "nav-link "href="index.php?action=user/form" >Search user</a></li> 
        <li><a class = "nav-link "href="index.php?action=login" >Login</a></li>
        <li><a class = "nav-link " href="index.php?action=logout">Logout</a></li>
        <li><a class = "nav-link "><?php if(isset($_SESSION['userRole'])) echo $_SESSION['username']; ?></a></li>
    </ul>
    </ul>
</nav>
