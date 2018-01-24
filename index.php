<?php
// CONNECT TO THE SERVER
require_once "connect.php";

// CREATE / LOAD SESSION
session_start();
if (!isset($_SESSION["first_connect"]) || $_SESSION["first_connect"] == true) {
    session_unset();
}
//session_unset();
$_SESSION["first_connect"] = false;
$_SESSION["errors"]["login"][0] = "Errors:<br>";
var_dump($_SESSION);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            position: relative;
        }

        .form_connect {
            position: absolute;
            margin: auto;
            left: 0;
            right: 0;
            top: 150px;
            background: #FFE;
            width: 300px;
            padding: 20px;
            border: 2px solid #CC7;
        }

        .form_connect > h2 {
            margin: 0 0 20px 0;
            text-align: center;
        }

        .form_connect > label {
            display: inline-block;
            width: 30%;
        }

        .form_connect > input {
            display: inline-block;
            width: 60%;
            box-sizing: border-box;
            margin: 0 0 10px 0;
        }

        .form_connect > input[type=submit] {
            width: 50%;
            margin: 20px auto 0;
            display: block;
        }

        .error_block {
            margin-top: 10px;
            background-color: #EED;
            border: 2px solid #BB6;
        }
    </style>
</head>
<body>
    <form class="form_connect" action="ACTION/ACTION_login.php" method="POST">
        <h2>LOGIN</h2>
        <label for="pseudo">Pseudo:</label>
        <input type="text" name="pseudo"   placeholder="Type in your pseudo">
        <label for="password">Password:</label>
        <input type="text" name="password" placeholder="Type in your password">
        <input type="submit" value="Connect">
        <p class="error_block" style="<?php echo (count($_SESSION["errors"]["login"]) > 1)? "" : "display: none" ?>">
            <?php
            // DISPLAY AND DELETE ALL LOGIN ERRORS
            $i = 1;
            echo $_SESSION["errors"]["login"][0];
            while (count($_SESSION["errors"]["login"]) > 1) {
                echo $_SESSION["errors"]["login"][$i];
                unset($_SESSION["errors"]["login"][$i]);
                $i++;
            }
            ?>
        </p>
    </form>
</body>
</html>