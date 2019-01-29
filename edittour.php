<?php
    include('_includes/config.inc');
    include('_includes/connect_db.php');
    include('_includes/header.html');
    include('_includes/nav.html');

    // Check if user is signed in and url is correct
    if(isset($_SESSION['userid']) && isset($_GET['tourid']) && $_GET['tourid'] != NULL){
        $userid = $_SESSION['userid'];
        $tourid = $_GET['tourid'];
        // SQL query getting tour details
        $sql = "SELECT * FROM tours WHERE tourid='$tourid'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        // SQL query getting room details
        $sql1 = "SELECT * FROM rooms WHERE tourid='$tourid'";
        $result1 = mysqli_query($conn,$sql1);

        // When user submits to save details
        if(isset($_POST['submit'])) {
            if(!empty($_POST['TOURNAME'])){
                $txtTourName = mysqli_real_escape_string($conn, $_POST['TOURNAME']);
                if(isset($_POST['TOURVIS'])){
                    $chkTourVis = 1;
                }
                else{
                    $chkTourVis = 0;
                }
                
                // SQL saving onto database
                $sql = "UPDATE tours SET tourname = '$txtTourName', tourvisible = '$chkTourVis' WHERE tourid = '$tourid'";
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
        // If user deletes floor plan
        if(isset($_POST['submitDelFP'])){
            unlink('uploadsFP/' . $_POST['submitDelFP']);
            $sqldel = "UPDATE tours SET tourfloorplan = NULL WHERE tourid = '$tourid'";
            $resultdel = mysqli_query($conn,$sqldel);
            header("Refresh:0");          
        }
        
        ?>

        <!-- Front end start -->
        <div class="container">
            <form method="post">
            <!-- Edit Tour Details -->
            <h2>Edit Tour</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Tour</li>
                </ol>
            </nav>
            <hr>
            <div class="row">
                <div class="col-sm">
                    <label for="exampleFormControlInput1">ID</label>
                    <input readonly class="form-control" id="exampleFormControlInput1" value="<?php echo $tourid; ?>">

                    <label for="exampleFormControlInput1">Tour Name</label>
                    <input name="TOURNAME" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['tourname']; ?>">
                    
                    <label for="exampleFormControlInput1">Created</label>
                    <input  readonly class="form-control" id="exampleFormControlInput1" value="<?php echo $row['tourcreated']; ?>">

                    <label for="exampleFormControlInput1">Views</label>
                    <input readonly class="form-control" id="exampleFormControlInput1" value="<?php echo $row['tourviews']; ?>">
                    
                    <label for="exampleFormControlInput1">Link To View (If visible)</label>
                    <input readonly class="form-control" id="exampleFormControlInput1" value="<?php echo "www.360noscope.com/viewtour.php?tourid=" . $tourid; ?>">

                    <div class="form-check" style="margin-top:10px;">
                        <input class="form-check-input"  name="TOURVIS" type="checkbox" id="defaultCheck1" <?php if($row['tourvisible'] == 1){echo "checked";}else{echo "";} ?>>
                        <label class="form-check-label" for="defaultCheck1">
                            Publicly Visible
                        </label>
                    </div>

                    <input style="margin-top:10px;" value="Update Details" type="submit" name="submit" class="btn btn-primary"/>
                    <a style="margin-top:10px;" href="viewtour.php?tourid=<?php echo $tourid ?>" class="btn btn-primary">View Tour</a>
                    </form>
                </div>
                <!-- Upload / View or Delete Floor Plan -->
                <div class="col-sm"> 
                    <div class="row" style="margin-top:30px;">
                        <!-- If the Floor Plan Exists -->
                        <?php if($row['tourfloorplan'] != NULL){ ?>
                        <div class="card" style="width: 100%;">
                            <img src="uploadsFP/<?php echo $row['tourfloorplan']; ?>" class="card-img-top" />
                            <div class="card-body">
                                <form action="edittour.php?tourid=<?php echo $tourid;?>" method="post" enctype="multipart/form-data">
                                    <input type="submit" value="Delete Floor Plan" name="submitDelFP" class="btn btn-danger">
                                </form>  
                            </div>
                        </div>
                    <?php } else{ ?>
                        <!-- Floor plan upload -->
                        <h2>Upload Floor Plan</h2>
                        <form action="uploadFP.php?tourid=<?php echo $tourid;?>" method="post" enctype="multipart/form-data">
                            Select image to upload:<br/>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <input type="submit" value="Upload Image" name="submitFP">
                        </form>
                    <?php } ?>
                    </div>
                </div>
            </div>

            <hr>
            <h2>Rooms</h2>
            
            <!-- Listing rooms associated with tour -->
            <table class="table table-hover" style="border-style: solid; border-width: 1px; border-color: #cecece;">
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Name</th>
                        <th>Floor</th>
                    </tr>
                </thead>
                    <?php while($row1 = mysqli_fetch_assoc($result1)){ ?>
                        <tr style="cursor:pointer;" onclick="window.location='editroom.php?roomid=<?php echo $row1["roomid"]; ?>''">
                            <?php if($row1['roomimage'] != NULL){ ?>
                                <td> <img src="uploads360/<?php echo $row1['roomimage']; ?>" style="width:250px; margin:0px auto 0px auto;" /> </td>
                            <?php } else{ ?>
                                <td>No Image Found</td>
                            <?php } ?>
                            
                            <td> <?php echo $row1["roomname"];?> </td>
                            <td> <?php echo $row1["roomfloor"];?> </td>
                        </tr>
                    <?php } ?>
            </table>

                <form action="_includes/submitaddroom.php?tourid=<?php echo $tourid; ?>" method="POST" style="width:100%;">
                    <div class="form-group">
                        <label>Add room, insert Room Name here</label>
                        <input type="text" class="form-control" name="roomname">
                        <input type="submit" value="Add Room" name="action" class="btn btn-primary" style="margin-top:10px;">
                    </div>  
                </form>







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