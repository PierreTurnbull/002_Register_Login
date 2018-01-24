<?php

// CONNECT TO THE SERVER
require_once "../connect.php";

// LOAD SESSION
session_start();

$error = false;
if (!isset($_POST) || !isset($_POST["pseudo"]) || !isset($_POST["password"])) {
    $_SESSION["errors"]["login"][] = "Unknown form post fail<br>";
    $error = true;
}
if ($_POST["pseudo"] == "" || $_POST["password"] == "") {
    $_SESSION["errors"]["login"][] = "Please use all fields<br>";
    $error = true;
}
if (strlen($_POST["pseudo"]) > 16) {
    $_SESSION["errors"]["login"][] = "Your pseudo cannot be more than 16 characters<br>";
    $error = true;
}
if ($error == true) {
    header("Location: ../index.php");
    exit;
}

header("Location: ../index.php");

?>