<?php
// CONNECT TO THE SERVER
require_once "connect.php";

// LOAD SESSION
session_start();
$_SESSION["errors"]["login"][0] = "Error:<br>";
$_SESSION["errors"]["register"][0] = "Error:<br>";

// MAKE SURE USER IS LOGGED IN
if (!$_SESSION["current_user"]) {
    echo "Sorry, you are not supposed to access this page! Please log in to access this page.";
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>You are connected as <?php echo $_SESSION["current_user"]; ?></p>
    <form action="index.php" method="POST">
        <input type="submit" value="Disconnect">
    </form>
</body>
</html>
