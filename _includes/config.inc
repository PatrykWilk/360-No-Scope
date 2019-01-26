<?php
    session_start();
    // controls the level of error reporting in PHP
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    // initialise $data array used for templating system (best practice)
    $data = array();
    $data['message'] = "";
    $data['content'] = "";
?>