<?php
    $servername = "uk59.siteground.eu";
    $username = "dhawserm_lads";
    $password = "7ehK3p6JEjhAP2Y";
    $database = "dhawserm_360noscope";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    //echo "Connected successfully";
?>