<?php
include('_includes/config.inc');
include('_includes/connect_db.php');
include('_includes/header.html');
include('_includes/nav.php');
// If user is signed in, load page.
if(isset($_SESSION['userid'])){
    $userid = $_SESSION['userid'];
    // SQL getting tours accosiated with user.
    $sql = "SELECT * FROM tours WHERE userid='$userid'";
	$result = mysqli_query($conn,$sql);
    ?>
    
    <!-- Temp Navigation -->
    <div class="col-xs-2" align="center">
    <h1>Welcome <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];?></h1>

    <hr>

    <h2>Add Tour</h2> 
    <!-- Add tour to user with just name -->
    <?php require('_includes/submitaddtour.php'); ?>
    <form action="dashboard.php" method="POST" style="width:100%;">
        
</br>
            <label><strong>Tour Name:</strong></label>
            <div class="input-group" style="width:30%;">
            <input type="text" class="form-control"  name="tourname" value="<?php if(isset($_POST['tourname'])) echo$_POST['tourname'];?>">
        
        <button type="submit" name="action" class="btn btn-primary" style="width: 15%; font-size: 1.1em; margin-top: -1px; margin-left:20px;">Add</button>
</div>

</form>
</br>
    <!-- List of user's tours, linked to edit pages -->
    <h2>Edit Tours</h2></br>
    <table class="table table-hover" style="width:48%;border-style: solid;">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Visibility</th>
            <th scope="col">Views</th>
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