<?php

// CONNECT TO THE SERVER
$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "002_Register_Login";
try {
    if (!$server = mysqli_connect($servername, $username, $password, $database)) {
        throw new Exception("Connection failed");
    }
} catch(Exception $ex) {
    echo $ex->getMessage();
    exit;
}
?>