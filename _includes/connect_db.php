<?php
    $servername = "dhawserm_360noscope";
    $username = "dhawserm_lads";
    $password = "7ehK3p6JEjhAP2Y";
    $database = "360noscope";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    //echo "Connected successfully";
?>