<?php   
include('_includes/config.inc');
include('_includes/connect_db.php');
if(isset($_POST['submitDelTour'])){
    $userid = $_SESSION['userid'];
    $tourid = $_GET['tourid'];
    $sqlT = "SELECT * FROM tours WHERE tourid='$tourid'";
    $sqlR = "SELECT * FROM rooms WHERE tourid='$tourid'";
    $resultT = mysqli_query($conn,$sqlT);
    $rowT = mysqli_fetch_array($resultT);
    $resultR = mysqli_query($conn,$sqlR);
    if($userid == $rowT['userid']){
        echo "Please wait...";
        while($rowR = mysqli_fetch_assoc($resultR)){
            unlink('uploads360/' . $rowR['roomimage']);
        }
        unlink('uploadsFP/' . $rowT['tourfloorplan']);
        $sqlDelR = "DELETE FROM rooms WHERE tourid='$tourid'";
        $resultDelR = mysqli_query($conn,$sqlDelR);
        $sqlDelT = "DELETE FROM tours WHERE tourid='$tourid'";
        $resultDelT = mysqli_query($conn,$sqlDelT);
        header( "refresh:1;url=dashboard.php");
    }
    else{
        echo '<h3 style="color:RED">404: Page could not be found.</h3>
            <p>You will be redirected shortly.</p>';
            header( "refresh:1;url=login.php" );
    }         
}
else{
    echo '<h3 style="color:RED">404: Page could not be found.</h3>
        <p>You will be redirected shortly.</p>';
        header( "refresh:1;url=login.php" );
}


?>