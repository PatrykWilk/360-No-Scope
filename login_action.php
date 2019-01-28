<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require('_includes/connect_db.php');
    require('login_tools.php');

    // Validation for email and password
    list($check, $data) = validate($conn, $_POST['email'], $_POST['pass']);
    if($check){
        session_start();

        // Session details
        $_SESSION['userid'] = $data['userid'];
        $_SESSION['firstname'] = $data['firstname'];
        $_SESSION['lastname'] = $data['lastname'];

        load('dashboard.php');
    }
    else{$errors = $data;}
    mysqli_close($conn);
}
include('login.php');
