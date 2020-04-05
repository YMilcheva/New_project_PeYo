<nav class="navbar navbar-expand-md">
   <a class="navbar-brand" href="index.php">Home</a>
    <div class="collapse navbar-collapse" id="main-navigation">
    <ul class="navbar-nav">     
      <li class="nav-item">
        <a class="nav-link" href="#">Hello <?php echo $_SESSION['user_name_first'] ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="profile.php">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Log Out</a>
      </li>
    </ul>
  </div>
</nav>