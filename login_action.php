<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require('_includes/connect_db.php');
    require('login_tools.php');

    list($check, $data) = validate($conn, $_POST['email'], $_POST['pass']);
    if($check){
        session_start();

        $_SESSION['userid'] = $data['userid'];
        $_SESSION['firstname'] = $data['firstname'];
        $_SESSION['lastname'] = $data['lastname'];
        $_SESSION['permiss'] = $data['permiss'];

        load('dashboard.php');
    }
    else{$errors = $data;}
    mysqli_close($conn);
}
include('login.php');
