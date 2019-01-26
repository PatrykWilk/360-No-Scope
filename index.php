<?php 
    include('_includes/config.inc');
    include('_includes/header.html');
?>

<h1>Welcome</h1>
<?php
    if(isset($_SESSION['userid'])){?>
        <p>You are logged in as <?php echo $_SESSION['firstname']?> <?php echo $_SESSION['lastname']?>.</p>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    <?php }
    else{?>
        <p>Create an account or sign in.</p>
        <a href="login.php">Login</a><br/>
        <a href="register.php">Register</a>
    <?php }
?>

<?php include('_includes/footer.html');?>