<nav class="navbar navbar-expand-sm navbar-light">
  <a class="navbar-brand" href="index.php">Home</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div class="collapse navbar-collapse" id="main_navigation">
    <ul class="navbar-nav">     
      <li class="nav-item">
        <a class="nav-link" href="#">Hello, <?php echo $_SESSION['user_name_first'] ?></a>
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