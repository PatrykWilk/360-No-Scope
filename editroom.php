<?php
    include('_includes/config.inc');
    include('_includes/connect_db.php');
    include('_includes/header.html');

    // Check if user is signed in and url is correct
    if(isset($_SESSION['userid']) && isset($_GET['roomid']) && $_GET['roomid'] != NULL){
        $userid = $_SESSION['userid'];
        $roomid = $_GET['roomid'];
        // SQL query getting room details
        $sql = "SELECT * FROM rooms WHERE roomid='$roomid'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);

        // When user submits to save details   
        if (isset($_POST['submit'])) {
            if(!empty($_POST['ROOMNAME']) && !empty($_POST['ROOMFLOOR'])){
                $txtRoomName = mysqli_real_escape_string($conn, $_POST['ROOMNAME']);
                $txtRoomFloor = mysqli_real_escape_string($conn, $_POST['ROOMFLOOR']);
                
                // SQL saving onto database
                $sql = "UPDATE rooms SET roomname = '$txtRoomName', roomfloor = '$txtRoomFloor' WHERE roomid = '$roomid'";
                $result = mysqli_query($conn,$sql);

                if ($conn->query($sql) === TRUE) {
                    header("Refresh:0");
                    exit();
                } 
                else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } 
            else{
                echo "Invalid inputs<br/>";
            }
        } ?>

        <!-- Temp Navigation -->
        <a href="index.php">Home</a><br/>
        <a href="dashboard.php">Dashboard</a><br/>
        <a href="account.php">Account</a><br/>
        <a href="logout.php">Logout</a>

        <!-- Edit room details -->
        <h2>Edit Room</h2>
        <form style="width:400px;" method="post">
            <div style="width:100%" class="form-group">
                <label for="exampleFormControlInput1">ID</label>
                <input readonly style="width:100%;" class="form-control" id="exampleFormControlInput1" value="<?php echo $roomid; ?>">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Room Name</label>
                <input  style="width:100%;" name="ROOMNAME" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['roomname']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Floor</label>
                <input  style="width:100%;" name="ROOMFLOOR" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['roomfloor']; ?>">
            </div>
            <input value="Update Details" type="submit" name="submit" class="btn btn-primary"/>
        </form>

        <!-- Upload 360 Image -->
        <h2>Upload 360 Image</h2>
        <form action="upload360.php?roomid=<?php echo $roomid;?>" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit360">
        </form>

        <?php
        include('_includes/footer.html');
    }
    else {
        echo '<h3 style="color:RED">404: Page could not be found.</h3>
                <p>You will be redirected shortly.</p>';
                header( "refresh:1;url=login.php" );
    }
?>