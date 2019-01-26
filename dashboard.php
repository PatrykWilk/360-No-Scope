<?php
include('_includes/config.inc');
if(isset($_SESSION['userid'])){
    include('_includes/header.html'); ?>

    <h1>Welcome <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];?></h1>
    <a href="index.php">Home</a><br/>
    <a href="account.php">Account</a><br/>
    <a href="logout.php">Logout</a>
<?php }
else{
    header("Location: index.php");
}
include('_includes/footer.html'); ?>