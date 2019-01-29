<?php
    include('_includes/config.inc');
    include('_includes/connect_db.php');
    include('_includes/header.html');
    include('_includes/nav.html');
    
    
    if(isset($_SESSION['userid'])){
    $id = $_SESSION['userid'];
    $sql = "SELECT * FROM users WHERE userid='$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    if (isset($_POST['submit'])) {
        if(!empty($_POST['FORENAME']) && !empty($_POST['SURNAME']) && !empty($_POST['EMAIL'])){
            $txtForename = mysqli_real_escape_string($conn, $_POST['FORENAME']);
            $txtSurname = mysqli_real_escape_string($conn, $_POST['SURNAME']);
            $txtEmail = mysqli_real_escape_string($conn, $_POST['EMAIL']);
            $txtCompany = mysqli_real_escape_string($conn, $_POST['COMPANY']);
            
            $sql = "UPDATE users SET firstname ='$txtForename', lastname ='$txtSurname', email ='$txtEmail', company='$txtCompany' WHERE userid = '$id'";
            $result = mysqli_query($conn,$sql);

            if ($conn->query($sql) === TRUE) {
                header("Location:dashboard.php");
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
    ?>
<div class="col-xs-1" align="center">
        <div class="down">
    <h3>Account Settings</h3>
    <form style="width:400px;" method="post">
        <div style="width:100%" class="form-group">
            <label style="margin-right:500px;" for="exampleFormControlInput1">ID</label>
            <input readonly style="width:100%;" class="form-control" id="exampleFormControlInput1" value="<?php echo $id; ?>">
        </div>
        <div class="form-group">
            <label style="margin-right:500px;" for="exampleFormControlInput1">Forename</label>
            <input  style="width:100%;" name="FORENAME" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['firstname']; ?>">
        </div>
        <div class="form-group">
            <label style="margin-right:500px;" for="exampleFormControlInput1">Surname</label>
            <input  style="width:100%;" name="SURNAME" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['lastname']; ?>">
        </div>
        <div class="form-group">
            <label style="margin-right:500px;" for="exampleFormControlInput1">Email</label>
            <input  style="width:100%;" name="EMAIL" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['email']; ?>">
        </div>
        <div class="form-group">
            <label style="margin-right:500px;" for="exampleFormControlInput1">Company</label>
            <input  style="width:100%;" name="COMPANY" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['company']; ?>">
        </div>
        <div id="id" style="margin-left:270px;">
        <input value="Update Details" type="submit" name="submit" class="btn btn-success"/>
</div>
    </form>     
</div>
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