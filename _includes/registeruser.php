<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require('_includes/connect_db.php');
    $errors = array();

    //firstname
    if (empty($_POST['firstname'])){
        $errors[] = 'Please enter your first name.';
    }
    else {$fn = mysqli_real_escape_string($conn, trim($_POST['firstname']));}

    //lastname
    if (empty($_POST['lastname'])){
        $errors[] = 'Please enter your last name.';
    }
    else {$ln = mysqli_real_escape_string($conn, trim($_POST['lastname']));}

    //email
    if (empty($_POST['email'])){
        $errors[] = 'The email address you have entered is invalid.';
    }
    else {$e = mysqli_real_escape_string($conn, trim($_POST['email']));}

    //password
    if (!empty($_POST['pass1'])){
        if ($_POST['pass1'] != $_POST['pass2']){
            $errors[]='Passwords do not match.';
        }
        else {$p = mysqli_real_escape_string($conn, trim($_POST['pass1']));}
    }
    else {$errors[] = 'Please enter your password.';}

    //email already exists
    if(empty($errors)){
        $q = "SELECT userid FROM users WHERE email='$e'";
        $r = mysqli_query($conn,$q);
        if(mysqli_num_rows($r)!=0){
            $errors[]='Email address is already registered. <a href="login.php">Login Here.</a>';
        }
        
    }
    
    //store data
    if (empty($errors)){
        $q = "INSERT INTO users (firstname, lastname, email, pass, regdate) VALUES ('$fn','$ln','$e',SHA1('$p'), NOW())";
        $r = mysqli_query($conn,$q);
        if($r){
            echo '<h3 style="color:green">SUCCESS</h3>
            <p>You are now registered. You will be redirected shortly.</p>';
            header( "refresh:4;url=login.php" );
        }
        mysqli_close($conn);
       
        exit();
    }
    else{
        echo '<div id="loginerror"><p id="err_msg">There was a problem:<br>';
        foreach($errors as $msg){
            echo "- $msg<br>";
        }
        echo '</p></div>';
        mysqli_close($conn);
    }
}

?>