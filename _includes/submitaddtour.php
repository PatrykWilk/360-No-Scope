<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require('_includes/connect_db.php');
    $errors = array();

    //tour name
    if (empty($_POST['tourname'])){
        $errors[] = 'Please enter tour name.';
    }
    else {$tn = mysqli_real_escape_string($conn, trim($_POST['tourname']));}

    //store data
    if (empty($errors)){
        $UserID = $_SESSION['userid'];
        $q = "INSERT INTO tours (tourname, tourcreated, userid) VALUES ('$tn', NOW(), '$UserID')";
        $r = mysqli_query($conn,$q);
        if($r == 1){
            header("Refresh:0");
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