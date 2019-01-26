<?php
session_start();
if(!isset($_SESSION['userid'])){
    require('login_tools.php');
    load();
}
$_SESSION = array();
session_destroy();
include ('_includes/header.html');
?>
    <h2 style="width:100%">Logging out</h2>
    <h3>SUCCESS</h3>
    <p>Redirecting to login page shortly.</p>
<?php
header("refresh:2;url=index.php");
die();
?>