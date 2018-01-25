<?php
// CONNECT TO THE SERVER
require_once "connect.php";

// CREATE / LOAD SESSION
session_start();
if (!isset($_SESSION["first_connect"]) || $_SESSION["first_connect"] == true) {
    session_unset();
}
$_SESSION["first_connect"] = false;
$_SESSION["errors"]["login"][0] = "Error:<br>";
$_SESSION["errors"]["register"][0] = "Error:<br>";
$_SESSION["current_user"] = "";

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

        .forms_container {
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

        .form_connect {
        }

        .forms_container h2 {
            margin: 0 0 20px 0;
            text-align: center;
        }

        .forms_container label {
            display: inline-block;
            width: 30%;
        }

        .forms_container input {
            display: inline-block;
            width: 60%;
            box-sizing: border-box;
            margin: 0 0 10px 0;
        }

        .forms_container input[type=submit] {
            width: 50%;
            margin: 20px auto 20px;
            display: block;
        }

        .error_block {
            margin: 10px 0;
            background-color: #EED;
            border: 2px solid #BB6;
            color: red;
        }
    </style>
</head>
<body>
    <div class="forms_container">
        <form class="form_register" action="ACTION/ACTION_register.php" method="POST">
            <h2>REGISTER</h2>
            <label for="username">Username:</label>
            <input type="text" name="username"   placeholder="Type in your username">
            <label for="password">Password:</label>
            <input type="text" name="password" placeholder="Type in your password">
            <input type="submit" value="Register">
            <p class="error_block" style="<?php echo (count($_SESSION["errors"]["register"]) > 1)? "" : "display: none" ?>">
                <?php
                // DISPLAY AND DELETE ALL LOGIN ERRORS
                $i = 1;
                echo $_SESSION["errors"]["register"][0];
                while (count($_SESSION["errors"]["register"]) > 1) {
                    echo $_SESSION["errors"]["register"][$i];
                    unset($_SESSION["errors"]["register"][$i]);
                    $i++;
                }
                ?>
            </p>
        </form>
        <form class="form_connect" action="ACTION/ACTION_login.php" method="POST">
            <h2>LOGIN</h2>
            <label for="username">Username:</label>
            <input type="text" name="username"   placeholder="Type in your username">
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
    </div>
</body>
</html>