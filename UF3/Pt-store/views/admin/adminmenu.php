

<nav class="navbar navbar-default navbar-expand-sm navbar-light bg-primary">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Store</a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li class="active"><a class="nav-link" href="index.php?action=home">Home</a></li>
        <li><a class="nav-link" href="index.php?action=user">Users</a></li>
        <li><a class="nav-link" href="index.php?action=category">Categories</a></li>
        <li><a class="nav-link" href="index.php?action=product">Products</a></li>
      </ul>
    </div>
    <?php if (isset($_SESSION['nameUser'])){
      echo "<div>".$_SESSION['nameUser']."</div>";
    }
    ?>
    
    <?php if (isset($_SESSION['nameUser'])){
      echo "<a class=\"btn btn-info navbar-btn\" href=\"index.php?action=logout\">logout</a>";
    }else {
      echo "<a class=\"btn btn-info navbar-btn\" href=\"index.php?action=loginform\">login</a>";
    }
    ?>
  </div>
</nav>

