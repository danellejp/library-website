<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
    <h1> Sign Up to Join the Community</h1>
    </header>

    <main>
<?php
session_start();
    require_once "connection.php";

    #string to hold error messages
    $error = "";

    #function to check if username already exists in database
    function isUsernameExists($conn, $username)
    {
        $checkUsernameQuery = "SELECT * FROM user WHERE user_name = '$username'";
        $result = $conn->query($checkUsernameQuery);

        #if a row is returned, username already exists
        return $result->num_rows > 0;
    }

    #submits all info to database if all fields are filled out
    if (isset($_POST['FirstName']) && !empty($_POST['FirstName']) &&
        isset($_POST['Surname']) && !empty($_POST['Surname']) &&
        isset($_POST['user_name']) && !empty($_POST['user_name']) &&
        isset($_POST['AddressLine']) && !empty($_POST['AddressLine']) &&
        isset($_POST['AddressLine2']) && !empty($_POST['AddressLine2']) &&
        isset($_POST['City']) && !empty($_POST['City']) &&
        isset($_POST['Telephone']) && !empty($_POST['Telephone']) &&
        isset($_POST['Mobile']) && !empty($_POST['Mobile']) && is_numeric($_POST['Mobile']) && strlen($_POST['Mobile']) == 10 &&
        isset($_POST['password']) && !empty($_POST['password']) && strlen($_POST['password']) >= 6 &&   
        isset($_POST['confirm_password']) && !empty($_POST['confirm_password']) && $_POST['password'] == $_POST['confirm_password'] )
    {
        $fn = $conn -> real_escape_string($_POST['FirstName']);
        $sn = $conn -> real_escape_string($_POST['Surname']);
        $un = $conn -> real_escape_string($_POST['user_name']);
        $al = $conn -> real_escape_string($_POST['AddressLine']);
        $al2 = $conn -> real_escape_string($_POST['AddressLine2']);
        $ct = $conn -> real_escape_string($_POST['City']);
        $tl = $conn -> real_escape_string($_POST['Telephone']);
        $mb = $conn -> real_escape_string($_POST['Mobile']);
        $pw = $conn -> real_escape_string($_POST['password']);

        #check if the username already exists
        if (isUsernameExists($conn, $un)) {
            $error = "Username already exists. Please choose a different username.";
        } else {
            #insert the user data into the database
            $sql = "INSERT INTO user (FirstName, Surname, user_name, AddressLine, AddressLine2, City, Telephone, Mobile, password) 
                    VALUES ('$fn', '$sn', '$un', '$al', '$al2', '$ct', '$tl', '$mb', '$pw')";

            #if the query is successful, display success message
            if ($conn->query($sql) === TRUE) {
                echo 'Registration Successful -> <a href="index.php">Click here to continue</a>';
            } else {
                $error = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else { #if any of the fields are not correctly met, display error message
        $error = 'Requirements for successful registration:<br>';
        $error .= 'All fields must be filled out.<br>';
        $error .= 'Mobile number must be 10 digits long.<br>';
        $error .= 'Password must be at least 6 characters long.<br>';
        $error .= 'Password and Confirm Password must match.<br>';
    }


#display error message if registration is unsuccessful
if (!empty($error)) {
    echo $error;
}
?>

    <div id="box">

        <form method="post">
            <p>First Name:
                <input type="text" name="FirstName"></p>
            <p>Surname:
                <input type="text" name="Surname"></p>
            <p>Username:
                <input type="text" name="user_name"></p>
            <p>Address Line 1:
                <input type="text" name="AddressLine"></p>
            <p>Address Line 2:
                <input type="text" name="AddressLine2"></p>
            <p>City:
                <input type="text" name="City"></p>
            <p>Telephone:
                <input type="text" name="Telephone"></p>
            <p>Mobile:
                <input type="text" name="Mobile"></p>
            <p>Password:
                <input type="password" name="password"></p>
            <p>Confirm Password:
                <input type="password" name="confirm_password"></p> 
            <p>Join:
                <input type="submit" value="Sign Up" class="signup-button"></p>
            <p>
                <a href="index.php" class="cancel-link">Cancel</a></p>
        </form>
    </div>
    </main>
<footer>
    Already have an account? <a href="login.php">Login</a>
</footer>   
</body>
</html>