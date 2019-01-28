<?php
include('_includes/config.inc');
include('_includes/connect_db.php');
if(isset($_SESSION['userid'])){
    include('_includes/header.html');
    $userid = $_SESSION['userid'];
    $sql = "SELECT * FROM tours WHERE userid='$userid'";
	$result = $conn->query($sql);
    ?>
    
    <!-- Temp Navigation -->
    <h1>Welcome <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];?></h1>
    <a href="index.php">Home</a><br/>
    <a href="account.php">Account</a><br/>
    <a href="logout.php">Logout</a><br/>

    <h2>Add Tour</h2>
    <?php require('_includes/submitaddtour.php'); ?>
    <form action="dashboard.php" method="POST" style="width:100%;">
        <div class="form-group">
            <label>Tour Name</label>
            <input type="text" class="form-control" name="tourname" value="<?php if(isset($_POST['tourname'])) echo$_POST['tourname'];?>">
        </div>  
        <button type="submit" name="action" style="width: 300px; font-size: 1.3em;margin-top:10px;">Submit</button>
    </form>
    <h2>Edit Tours</h2>
    <table style="width:500px;border-style: solid;">
        <tr>
            <th>Tour ID</th>
            <th>Name</th>
            <th>Visibility</th>
            <th>Views</th>
        </tr>
        <tr>
            <?php while($row = mysqli_fetch_assoc($result)){ ?>
				<tr style="cursor:pointer;" onclick="window.location='edittour.php?tourid=<?php echo $row["tourid"]; ?>'">
					<td> <?php echo $row["tourid"];?> </td>
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