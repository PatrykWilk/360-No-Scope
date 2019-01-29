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
    
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <h2 style="width:100%">Logging out..</h2>
    <h3>You've succesffuly logged out!</h3>
    <hr>
    <p>Redirecting to login page shortly.</p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
    
    
<?php
header("refresh:2;url=index.php");
die();
?>