<?php
    include('_includes/config.inc');
    include('_includes/connect_db.php');
    include('_includes/header.html');
    $tourid = $_GET['tourid'];
    $sql = "SELECT * FROM tours WHERE tourid='$tourid'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    if(isset($_SESSION['userid'])){$userID=$_SESSION['userid'];}else{$userID=NULL;}
    if($row['tourvisible'] == 1 || $userID == $row['userid']){ ?>
        <h1>Visible Tour / Owner View</h1>
    
    
    
    
    
    <?php 
        include('_includes/footer.html');
    }
    else{
        echo "<h1>Tour not public.</h1>";
    }
    ?>
    
    
    
    
    