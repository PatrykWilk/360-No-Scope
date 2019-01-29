<?php 
    include('_includes/config.inc');
    include('_includes/header.html');
    include('_includes/nav.php');
?>

<div class="container">
<h1>Welcome</h1><hr>
<?php
    if(isset($_SESSION['userid'])){?>
        <p>You are logged in as <?php echo $_SESSION['firstname']?> <?php echo $_SESSION['lastname']?>.</p>
        <a style="margin-top:10px;" href="dashboard.php" class="btn btn-primary">Dashboard</a>
        <a style="margin-top:10px;" href="logout.php" class="btn btn-primary">Logout</a>
    <?php }
    else{?>
        <p>Create an account or sign in.</p>
        <a style="margin-top:10px;" href="login.php" class="btn btn-primary">Login</a>
        <a style="margin-top:10px;" href="register.php" class="btn btn-primary">Register</a>
    <?php }
?>
</div>

<?php include('_includes/footer.html');?>