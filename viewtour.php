<?php
    include('_includes/config.inc');
    include('_includes/connect_db.php');
    include('_includes/header.html');
    
    $tourid = $_GET['tourid'];

    //SQL STATEMENTS
    $getimg = "SELECT * from rooms where tourid='$tourid'";
    $sql = "SELECT * FROM tours WHERE tourid='$tourid'";

    //CALLING SQL
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);

    $roomres = mysqli_query($conn, $getimg);
    $roomrows = mysqli_num_rows($roomres);

    //Putting things into array

    if ($roomrows > 0){

        // $room_arr = array();

        while($roomrow = mysqli_fetch_array($roomres)) {            
            $room_name[] = $roomrow['roomname'];
            $room_img[] = $roomrow['roomimage'];
        }

        
    }



    //CHECKING IF PAGE IS PUBLIC / IF USER IS LOGGED IN -> DISPLAY PAGE ACCORDINGLY
    if(isset($_SESSION['userid'])){$userID=$_SESSION['userid'];}else{$userID=NULL;}
    if($row['tourvisible'] == 1 || $userID == $row['userid']){ ?>
    <head>
        <script src="https://naver.github.io/egjs-view360/common/js/jquery-2.2.4.js"></script>
        <script src="node_modules\@egjs\view360\dist\view360.pkgd.js"></script>
    </head>
    <body>
        <?php if($row['userid'] == $userID) {
            include('_includes/nav.php'); ?>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="edittour.php?tourid=<?php echo $tourid; ?>">Edit Tour</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Tour</li>
                </ol>
            </nav>
        <?php } ?>
        <div class="container">

            <div class="fp">
                <img id="fpimg" src="uploadsFP/<?php echo $row['tourfloorplan']; ?>" class="fp d-none" />
            </div>          

            <?php if($roomrows != 0) { ?>
            <div id="myPanoViewer" class="viewer"></div>
            <h1 class="text-center d-inline"><?php echo $row['tourname'];?></h1>
            <div class="subtext">
                <span>Select Room:</span>
                <select id="selectRoom" class="selector" onchange="getname(this)">
                <?php 
                foreach ($room_name as $index => $name) {
                    ?> <option value="<?php echo $room_img[$index] ?>"><?php echo $name ?></option>   
                    <?php
                }
                ?>
                </select>
            </div>
        </div>
            <div class="container">
                <button id="fpbtn" class="btn btn-primary float-right mt-3" onclick="showFP()">Show Floorplan</button>  
            </div>

        <script>
            var y = 0;
            var x = "<?php 
            if($room_img){
                echo $room_img[0];
            } else {
                echo "";
            }
            ?>";
            function getname(selectObject){
                x = selectObject.value;
                // create PanoViewer with option
                var PanoViewer = eg.view360.PanoViewer;
                const panoViewer = new PanoViewer(
                    document.getElementById("myPanoViewer"),
                    {
                        image: "uploads360/"+x
                    }
                )
            };

            function showFP(){
                if (y == 0) {
                    document.getElementById("fpimg").classList = "fp d-block";
                    document.getElementById("myPanoViewer").classList ="viewer d-none";
                    document.getElementById("fpbtn").innerHTML = "Show 360 View";
                    y++;
                } else {
                    document.getElementById("fpimg").classList = "fp d-none";
                    document.getElementById("myPanoViewer").classList ="viewer d-block";
                    document.getElementById("fpbtn").innerHTML = "Show Floorplan";
                    y--;
                }
                
                
                // fpimg.classList.add("d-block");
                // var viewer = document.getElementById("");
                // viewer.classList.add("d-none");

            };
            
            var PanoViewer = eg.view360.PanoViewer;
                const panoViewer = new PanoViewer(
                document.getElementById("myPanoViewer"),
                {
                    image: "uploads360/"+x
                }
            )

        </script>
        <?php } ?>

    </body>
    
    
    
    
    
    <?php 
        include('_includes/footer.html');
    }
    else{
        echo "<h1>Tour not public.</h1>";
    }
    ?>
    
    
    
    
    