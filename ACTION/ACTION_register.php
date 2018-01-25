<?php

// CONNECT TO THE SERVER
require_once "../connect.php";

// LOAD SESSION
session_start();

// GET DATA
$query  = "SELECT * FROM data";
$stmt   = $server->prepare($query);
$stmt->execute();
$data   = $stmt->get_result()->fetch_all();
var_dump($data);

// CHECK IF USER INPUT IS INCORRECT
// IF POST SOMEHOW FAILED
if (!isset($_POST) || !isset($_POST["username"]) || !isset($_POST["password"])) {
    $_SESSION["errors"]["register"][] = "Unknown form post fail<br>";
    header("Location: ../index.php");
    exit;
} else
// IF NOT ALL FIELDS ARE USED
    if ($_POST["username"] == "" || $_POST["password"] == "") {
    $_SESSION["errors"]["register"][] = "Please use all fields<br>";
    header("Location: ../index.php");
    exit;
} else
// IF USERNAME IS TOO LONG
    if (strlen($_POST["username"]) > 16 ) {
    $_SESSION["errors"]["register"][] = "Username must be at most 16 characters long<br>";
    header("Location: ../index.php");
    exit;
} else
// IF USERNAME IS TOO SHORT
    if (strlen($_POST["username"]) < 3 ) {
    $_SESSION["errors"]["register"][] = "Username must be at least 3 characters long<br>";
    header("Location: ../index.php");
    exit;
} else
// IF PASSWORD IS TOO LONG
    if (strlen($_POST["password"]) > 32 ) {
    $_SESSION["errors"]["register"][] = "Password must be at most 32 characters long<br>";
    header("Location: ../index.php");
    exit;
} else
// IF PASSWORD IS TOO SHORT
    if (strlen($_POST["password"]) < 3 ) {
    $_SESSION["errors"]["register"][] = "Password must be at least 3 characters long<br>";
    header("Location: ../index.php");
    exit;
}

// CHECK IF USERNAME ALREADY EXISTS
$i = 0;
while ($i < count($data)) {
    if ($data[$i][0] == $_POST["username"]) {
        //TODO
        $_SESSION["errors"]["register"][] = "This username already exists";
        header("Location: ../index.php");
        exit;
    }
    $i++;
}

// HASH PASSWORD
$hashed_password = password_hash($_POST["password"], PASSWORD_BCRYPT);

// REGISTER USERNAME AND PASSWORD
$query  = "INSERT INTO data(username, password) VALUES(?, ?)";
$stmt   = $server->prepare($query);
$stmt->bind_param("ss", $_POST["username"], $hashed_password);
$stmt->execute();

header("Location: ../index.php");
?>