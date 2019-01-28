<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require('connect_db.php');
    $errors = array();

    //tour name
    if (empty($_POST['roomname'])){
        $errors[] = 'Please enter room name.';
    }
    else {$tn = mysqli_real_escape_string($conn, trim($_POST['roomname']));}

    //store data
    if (empty($errors)){
        $TourID = $_GET['tourid'];
        $q = "INSERT INTO rooms (roomname, tourid) VALUES ('$tn', '$TourID')";
        $r = mysqli_query($conn,$q);
        if($r == 1){
            header( "refresh:0;url=../edittour.php?tourid=" . $TourID );
        }
        mysqli_close($conn);
       
        exit();
    }
    else{
        echo "There was a problem:<br>";
        foreach($errors as $msg){
            echo "- $msg<br>";
        }
        echo '</p></div>';
        
        mysqli_close($conn);
    }
}

?>