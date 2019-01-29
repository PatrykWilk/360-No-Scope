<?php
$target_dir = "uploads360/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit360"]) && isset($_GET['roomid'])) {
    include('_includes/connect_db.php');
    $roomid = $_GET['roomid'];
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        header("Location: editroom.php?roomid=" . $roomid);
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    header("Location: editroom.php?roomid=" . $roomid);
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    header("Location: editroom.php?roomid=" . $roomid);
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    header("Location: editroom.php?roomid=" . $roomid);
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        sleep(1);
        rename($target_dir . $_FILES["fileToUpload"]["name"] , $target_dir . $roomid . "_360view." . $imageFileType);
        $name = $roomid . "_360view." . $imageFileType;
        $sql = "UPDATE rooms SET roomimage = '$name' WHERE roomid = '$roomid'";
        $result = mysqli_query($conn,$sql);
        header("Location: editroom.php?roomid=" . $roomid);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>