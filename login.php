<?php 
    include('_includes/config.inc');

if(isset($_SESSION['userid'])){
    header("Location: dashboard.php");
}
else{
    $page_title = 'Login';
    include('_includes/header.html');
    ?>

    <div id="loginbox" style="width:400px;">
            <h2>Login</h2>
            <hr>
    <h1>cyka</h1>
                <?php
                    if (isset($errors) && !empty($errors)){
                        echo '<div id="loginerror"><p id="err_msg">There was a problem:<br>';
                        foreach($errors as $msg){
                            echo "- $msg<br>";
                        }
                        echo '</p></div>';
                    }
                ?>
            <form action="login_action.php" method="POST" style="width:100%;">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email">
                </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="pass">
                </div>
                <button class="btn btn-primary" type="submit" name="action" style="width: 100%; font-size: 1.3em;margin-top:10px;">Login</button>
            </form>
            <hr>
            <label style="margin:0px auto 0px auto;">New to 360 No Scope?</label>
            <button class="btn btn-primary" type="submit" name="action" style="width: 100%; font-size: 1.3em; margin-top:10px;" onclick="location.href='register.php';">Register</button>
        </div>
    </div>
    <?php include ('_includes/footer.html');} ?>




