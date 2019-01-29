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

        while($roomrow = mysqli_fetch_array($roomres)) {
            $room_arr[] = $roomrow['roomimage'];
        }

        print_r($room_arr);


    }

    //CHECKING IF PAGE IS PUBLIC / IF USER IS LOGGED IN -> DISPLAY PAGE ACCORDINGLY
    if(isset($_SESSION['userid'])){$userID=$_SESSION['userid'];}else{$userID=NULL;}
    if($row['tourvisible'] == 1 || $userID == $row['userid']){ ?>
    <head>
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="styles/360.css">
        <script src="https://naver.github.io/egjs-view360/common/js/jquery-2.2.4.js"></script>
        <script src="node_modules\@egjs\view360\dist\view360.pkgd.js"></script>
    </head>
    <body>
        <h1>Visible Tour / Owner View</h1>

        <select id="selectRoom" onchange="getname(this)">
        <?php 
        foreach ($room_arr as $r) {
            ?> <option value="<?php echo $r ?>"><?php echo $r ?></option>   
            <?php
        }
        ?>
        </select>


        <div id="myPanoViewer" class="viewer"></div>

        <script>
            var x;
            function getname(selectObject){
                x = selectObject.value;
                console.log(x);
                var PanoViewer = eg.view360.PanoViewer;
                const panoViewer = new PanoViewer(
                document.getElementById("myPanoViewer"),
                {
                    image: "uploads/"+x
                }
                )};           

            // create PanoViewer with option
              

            
        </script>

    </body>
    
    
    
    
    
    <?php 
        include('_includes/footer.html');
    }
    else{
        echo "<h1>Tour not public.</h1>";
    }
    ?>
    
    
    
    
    