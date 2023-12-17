<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Reservation</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div id="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="search.php">Search for a Book</a></li>
                <li><a href="view.php">View My Reserved Books</a></li>
                <li><a href="logout.php">Log out</a></li>
            </ul>
        </div>
        <h1>Delete Reservation</h1>
    </header>

    <main>
        <?php
        session_start();
        require_once "connection.php";

        #checks if user is logged in
        if ( !isset($_SESSION["info"]) )
            { ?>
            Please <a href="login.php">Log In</a> to delete a reservation.
            <?php
            }
            else { ?>

        <section>
        <?php

    if (isset($_POST['id'])) {
        #updates book table information to show book is not reserved
        $id = $conn -> real_escape_string($_GET['ISBN']);
        $sql = "UPDATE book SET Reserved= 'N' WHERE ISBN= '$id'";
        $conn->query($sql);

        #deletes reservation from reserved table 
        $sql2 = "DELETE FROM reserved WHERE ISBN= '$id'";
        $conn->query($sql2);
        echo '<h2> Reservation Successfully Deleted </h2><br>
        <a href="index.php">Return to Home Page </a>
        ';

        return;
    }

    $id = $conn -> real_escape_string($_GET['ISBN']);
    #Formulate the SQL query to retrieve book information based on the ISBN
    $sql = "SELECT BookTitle, Author, ISBN FROM book WHERE ISBN='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    #store the book information in variables
    $n = htmlentities($row['BookTitle']);
    $a = htmlentities($row['Author']);  
    $id = htmlentities($row['ISBN']);

        #displays confirmation message to user
        echo <<< _END
            <h3>Confirm Reservation Deletion</h3>
            <form method="post">
                <p>Are you sure you want to delete your reservation for <b>"$n"</b> by <b>$a</b>?</p>
                <input type="hidden" name="id" value="$id">
                <p><input type="submit" value="Yes, I am sure"/>
                    <a href="view.php">No, take me back</a></p>
            </form>
        _END;
    ?>
        </section>
        <?php } ?>
    </main>   
</body>
<footer>
    2023 Blanchardstown Library, Contact: 01 188 5443
</footer>
</html>