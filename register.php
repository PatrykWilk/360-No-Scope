<?php
    $page_title = 'Register';
    include('_includes/config.inc');
    if(isset($_SESSION['userid'])){
        header("Location: dashboard.php");
    }
    include('_includes/header.html');
    include('_includes/nav.php');
?>
    <div class="col-xs-1" align="center">
<div style="width:400px;">
    <h2>Register</h2>
    <hr style="border-color: #1a237e;">

    <?php require('_includes/registeruser.php'); ?>
    <form action="register.php" method="POST" style="width:100%;">
        <div class="form-group">
            <label style="margin-right:320px;">First Name</label>
            <input type="text" class="form-control" name="firstname" value="<?php if(isset($_POST['firstname'])) echo$_POST['firstname'];?>">
        </div>
        <div class="form-group">
            <label style="margin-right:320px;">Last Name</label>
            <input type="text" class="form-control" name="lastname" value="<?php if(isset($_POST['lastname'])) echo$_POST['lastname'];?>">
        </div>
        <div class="form-group">
            <label style="margin-right:290px;">Email address</label>
            <input type="email" class="form-control" name="email" value="<?php if(isset($_POST['email'])) echo$_POST['email'];?>">
        </div>
        <div class="form-group">
            <label style="margin-right:320px;">Password</label>
            <input type="password" class="form-control" name="pass1" value="<?php if(isset($_POST['pass1'])) echo$_POST['pass1'];?>">
        </div>
        <div class="form-group">
            <label style="margin-right:260px;">Confirm Password</label>
            <input type="password" class="form-control" name="pass2" value="<?php if(isset($_POST['pass2'])) echo$_POST['pass2'];?>">
        </div>
        <button class="btn btn-primary" type="submit" name="action" style="width: 100%; font-size: 1.3em;margin-top:10px;">Register</button>
    </form>
</div>
</div>


