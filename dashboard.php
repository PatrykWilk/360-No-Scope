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
    $result = mysqli_query($conn,$sql); ?>
    
    <div class="container">
        <!-- Temp Navigation -->
        <h1>Welcome <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];?></h1>
        <hr>
        <!-- Add tour to user with just name -->
        <?php require('_includes/submitaddtour.php'); ?>
        <form action="dashboard.php" method="POST" style="width:100%;">
            <h4>Add Tour</h4>
            <div class="input-group" style="width:50%;">
                <input placeholder="Tour name" type="text" class="form-control"  name="tourname" value="<?php if(isset($_POST['tourname'])) echo$_POST['tourname'];?>"> 
                <button type="submit" name="action" class="btn btn-primary" style="width: 30%; font-size: 1.1em; margin-top: -1px; margin-left:20px;">Add</button>
            </div>
        </form>

        <!-- List of user's tours, linked to edit pages -->
        <h2 style="margin-top:20px;">Your Tours</h2>
        <table class="table table-hover" style="border-style: solid; border-width: 1px; border-color: #cecece;">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Visibility</th>
                    <th scope="col">Views</th>
                </tr>
            </thead>
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
    </div>
            
<?php }
else{
    header("Location: index.php");
}
include('_includes/footer.html'); ?>