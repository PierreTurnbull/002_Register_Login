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

function check_username($username, $data) {
    $i = 0;
    while ($data[$i] != null) {
        if ($data[$i][0] == $username) {
            return true;
        }
        $i++;
    }
    return false;
}

function check_password($username, $password, $data) {
    $i = 0;
    while ($data[$i] != null) {
        if ($data[$i][0] == "$username" && password_verify($password, $data[$i][1])) {
            return true;
        }
        $i++;
    }
    return false;
}

// CHECK IF USER'S INPUT IS INCORRECT
// IF POST SOMEHOW FAILED
if (!isset($_POST) || !isset($_POST["username"]) || !isset($_POST["password"])) {
    $_SESSION["errors"]["login"][] = "Unknown form post fail<br>";
    header("Location: ../index.php");
    exit;
} else
// IF NOT ALL FIELDS ARE USED
    if ($_POST["username"] == "" || $_POST["password"] == "") {
    $_SESSION["errors"]["login"][] = "Please use all fields<br>";
    header("Location: ../index.php");
    exit;
} else
// IF USERNAME DOESN'T EXIST
    if (check_username($_POST["username"], $data) == false) {
    $_SESSION["errors"]["login"][] = "This username doesn't exist<br>";
    header("Location: ../index.php");
    exit;
} else
// IF PASSWORD IS WRONG
    if (check_password($_POST["username"], $_POST["password"], $data) == false) {
    $_SESSION["errors"]["login"][] = "Wrong password<br>";
    header("Location: ../index.php");
    exit;
}

// IF LOGIN IS SUCCESFUL
var_dump($_SESSION["current_user"]);
$_SESSION["current_user"] = $_POST["username"];
header("Location: ../home.php");

?>