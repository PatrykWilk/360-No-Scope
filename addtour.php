<?php
include('_includes/config.inc');
include('_includes/connect_db.php');
if(isset($_SESSION['userid'])){
    include('_includes/header.html');
    ?>

    <!-- Temp Navigation -->
    <a href="index.php">Home</a><br/>
    <a href="dashboard.php">Dashboard</a><br/>
    <a href="logout.php">Logout</a><br/>
    <a href="addtour.php">Add Tour</a><br/><br/>

    <?php require('_includes/submitaddtour.php'); ?>
    <form action="addtour.php" method="POST" style="width:100%;">
        <div class="form-group">
            <label>Tour Name</label>
            <input type="text" class="form-control" name="tourname" value="<?php if(isset($_POST['tourname'])) echo$_POST['tourname'];?>">
        </div>
        <div class="form-group">
            <label>Upload Image (.jpeg only)</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
        
        <button type="submit" name="action" style="width: 300px; font-size: 1.3em;margin-top:10px;">Submit</button>
    </form>











    <?php }
else{
    header("Location: index.php");
}
include('_includes/footer.html'); ?>