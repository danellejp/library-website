<?php
session_start();
require_once 'connection.php';
unset($_SESSION["info"]);

#checks when user has entered account info
if (isset($_POST["info"]) && isset($_POST["pw"])) {
    $u = $conn->real_escape_string($_POST['info']); 
    $p = $conn->real_escape_string($_POST['pw']);

    #combine the conditions into a single query to check both username and password
    $sql = "SELECT user_name FROM user WHERE user_name = '$u' AND password = '$p'";
    $result = $conn->query($sql);

    #check if a row is returned, indicating a successful login
    #checks if username and password are correct
    if ($result->num_rows === 1) {
        $_SESSION["info"] = $_POST["info"];
        $_SESSION["success"] = "You are now logged in";
        header("Location: index.php");
        return;
    #if username and password are incorrect, redirect to login page
    } else {
        $_SESSION["error"] = " Invalid/missing username or password";
        header('Location: login.php');
        return;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="font-family: sans-serif;">
<main>
    <h1>Welcome to Blanchardstown Library</h1>
    <h3>Please login to access services</h3>
    <?php

    #display error message if login is unsuccessful
    if (isset($_SESSION["error"])) {
        echo('<p style="color:red">Error:' . $_SESSION["error"] . "</p>\n");
        unset($_SESSION["error"]);
    }
    #display success message if login is successful
    if (isset($_SESSION["success"])) {
        echo('<p style="color:green">Success:' . $_SESSION["success"] . "</p>\n");
        unset($_SESSION["success"]);
    }
    ?>

    <form method="post">
        <p>Username: <input type="text" name="info" value=""></p>
        <p>Password: <input type="password" name="pw" value=""></p>
        <p>Login:<input type="submit" value="Login" class="login-button"></p>
        <p>Don't have an account? 
            <a href="signup.php" class="signup-button">Register Here</a>
        </p>
    </form>
</main>
</body>
<footer>
    2023 Blanchardstown Library Services, Contact: 01 188 5443
</footer>   
</html>
