<?php
include('_includes/config.inc');
include('_includes/connect_db.php');
include('_includes/header.html');
include('_includes/nav.html');
// If user is signed in, load page.
if(isset($_SESSION['userid'])){
    $userid = $_SESSION['userid'];
    // SQL getting tours accosiated with user.
    $sql = "SELECT * FROM tours WHERE userid='$userid'";
	$result = mysqli_query($conn,$sql);
    ?>
    
    <!-- Temp Navigation -->
    <h1>Welcome <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];?></h1>

    <h2>Add Tour</h2>
    <!-- Add tour to user with just name -->
    <?php require('_includes/submitaddtour.php'); ?>
    <form action="dashboard.php" method="POST" style="width:100%;">
        <div class="form-group">
            <label>Tour Name</label>
            <input type="text" class="form-control" name="tourname" value="<?php if(isset($_POST['tourname'])) echo$_POST['tourname'];?>">
        </div>  
        <button type="submit" name="action" style="width: 300px; font-size: 1.3em;margin-top:10px;">Submit</button>
    </form>

    <!-- List of user's tours, linked to edit pages -->
    <h2>Edit Tours</h2>
    <table style="width:500px;border-style: solid;">
        <tr>
            <th>Name</th>
            <th>Visibility</th>
            <th>Views</th>
        </tr>
        <tr>
            <!-- Output accosiated tours into a table -->
            <?php while($row = mysqli_fetch_assoc($result)){ ?>
				<tr style="cursor:pointer;" onclick="window.location='edittour.php?tourid=<?php echo $row["tourid"]; ?>'">
					<td> <?php echo $row["tourname"];?> </td>
					<td> <?php if($row["tourvisible"] == 1){echo "Public";}else{echo "Private";}?> </td>
                    <td> <?php echo $row["tourviews"];?> </td>
				</tr>
			<?php } ?>
        </tr>
    </table>











<?php }
else{
    header("Location: index.php");
}
include('_includes/footer.html'); ?>