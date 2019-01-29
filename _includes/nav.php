<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom:10px;">
  <a class="navbar-brand" href="#">360&#176; No Scope</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <?php if(isset($_SESSION['userid'])){ ?>
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="account.php">Account</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
      <?php } else { ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
      <?php } ?>
    </ul>
  </div>
</nav>