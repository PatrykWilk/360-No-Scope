<?php

function load($page = 'login.php'){
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    $url = rtrim($url, '/\\');
    $url .= '/' . $page;
    header("Location: $url");
    exit();
}

function validate($conn , $email = "", $pwd = ""){
    $errors = array();
    
    if(empty($email)){
        $errors[] = 'Please enter your email address.';
    }
    else{$e = mysqli_real_escape_string($conn, trim($email));}
    
    if(empty($pwd)){
        $errors[] = 'Please enter your password.';
    }
    else{$p = mysqli_real_escape_string($conn, trim($pwd));}

    if (empty($errors)){
        $q = "SELECT userid, firstname, lastname, permiss FROM users WHERE email = '$e' AND pass = SHA1('$p')";
        $r = mysqli_query($conn, $q);

        if(mysqli_num_rows($r) == 1){
            $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
            
            return array(true, $row);
        }
        else{$errors[] = 'Email and/or password not found.';}
    }
    return array(false, $errors);
}

?>