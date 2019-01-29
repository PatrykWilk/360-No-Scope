<?php
    include('_includes/config.inc');
    include('_includes/connect_db.php');
    include('_includes/header.html');
    include('_includes/nav.php');

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
        }

        if (isset($_POST['delete'])) {
            $dsql = "DELETE FROM rooms WHERE roomid = $roomid";
            $dres = mysqli_query($conn,$dsql);
            header("location:edittour.php?tourid=8");
        }

        if(isset($_POST['submitDel360'])) {
            unlink('uploads360/' . $row['roomimage']);
            $sqldel = "UPDATE rooms SET roomimage = NULL WHERE roomid = '$roomid'";
            $resultdel = mysqli_query($conn,$sqldel);
            header("Refresh:0");          
        }
        ?>

        <head>
            <script src="https://naver.github.io/egjs-view360/common/js/jquery-2.2.4.js"></script>
            <script src="node_modules\@egjs\view360\dist\view360.pkgd.js"></script>
        </head>

        <div class="container">
            <h2>Edit Room</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="edittour.php?tourid=<?php echo $row['tourid']; ?>">Edit Tour</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Room</li>
                </ol>
            </nav>
            <hr>
            <!-- Edit room details -->
            <form method="post">
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1">ID</label>
                        <input readonly style="width:100%;" class="form-control" id="exampleFormControlInput1" value="<?php echo $roomid; ?>">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">Room Name</label>
                        <input  style="width:100%;" name="ROOMNAME" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['roomname']; ?>">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">Floor</label>
                        <input  style="width:100%;" name="ROOMFLOOR" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['roomfloor']; ?>">
                    </div>
                </div>
                <input style="margin-top:10px;" value="Update Details" type="submit" name="submit" class="btn btn-primary"/>
                <input style="margin-top:10px;" value="Delete Room" type="submit" name="delete" class="btn btn-danger"/>                
            </form>

            <!-- Upload room image -->
            <?php if($row['roomimage'] != NULL){ ?>
                <!-- If there's an image show 360 view -->
                <div class="card" style="width:100%;margin:20px 0px 20px 0px;">
                    <div class="card-body">
                        <!-- Delete 360 Image -->
                        <h3>Preview 360 Image</h3>
                        <form action="editroom.php?roomid=<?php echo $roomid;?>" method="post" enctype="multipart/form-data">
                            <input type="submit" value="Delete 360 Image" name="submitDel360" class="btn btn-danger">
                        </form>     
                    </div>

                    <div id="myPanoViewer" class="viewer"></div>

                    <!-- PATRYK: REPLACE IMG WITH 360 VIEW -->
                    <script>
                        var x = "<?php echo $row['roomimage']; ?>";
                        var PanoViewer = eg.view360.PanoViewer;
                        const panoViewer = new PanoViewer(
                        document.getElementById("myPanoViewer"),
                        {
                            image: "uploads360/"+x
                        }
                        )
                    </script>




                </div>
            <?php }
            else{ ?>
                <!-- Upload 360 Image -->
                <h2 style="margin-top:30px;">Upload 360 Image</h2>
                <form action="upload360.php?roomid=<?php echo $roomid;?>" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit360">
            </form>
                
            <?php } ?>
        </div>
        <?php
        include('_includes/footer.html');
    }
    else {
        echo '<h3 style="color:RED">404: Page could not be found.</h3>
                <p>You will be redirected shortly.</p>';
                header( "refresh:1;url=login.php" );
    }
?>