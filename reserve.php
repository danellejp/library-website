<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve</title>
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
        <h1>Reserve a Book</h1>
    </header>

    <main>
        <?php
        session_start();
        require_once "connection.php";

        #checks if user is logged in
        if ( !isset($_SESSION["info"]) )
            { ?>
            Please <a href="login.php">Log In</a> to reserve a book.
            <?php
            }
            else { ?>

        <section>
        <?php

    #if user is logged in, display reserve form when user has submitted a search
    if (isset($_POST['id'])) {
        #reserves book 
        $id = $conn->real_escape_string($_GET['ISBN']);
        #updates book table to show book is reserved
        $sql = "UPDATE book SET Reserved= 'Y' WHERE ISBN= '$id'";
        $conn->query($sql);

        #updates reserved table with user's username and current date
        $n = $_SESSION["info"];
        $d = date("Y/m/d");

        #inserts data into reserved table 
        $sql2 = "INSERT INTO reserved (ISBN, UserName, ReservedDate) VALUES ('$id', '$n', '$d')";
        $conn->query($sql2);
        echo '<h2> Book Successfully Reserved </h2><br>
        <a href="view.php">Reserve another book </a><br><br>
        <a href="index.php">Return to Home Page </a>
        ';

        return;
    }

    #gets book details from book table
    $id = $conn->real_escape_string($_GET['ISBN']);
    $sql = "SELECT BookTitle, Author, ISBN FROM book WHERE ISBN = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    #displays book details and confirmation form
    $n = htmlentities($row['BookTitle']);
    $a = htmlentities($row['Author']);
    $id = htmlentities($row['ISBN']);
    
    echo <<< _END
        <h3>Confirm Reservation</h3>
        <form method="post">
            <p>Are you sure you want to reserve "$n" by "$a"?</p>
            <input type="hidden" name="id" value="$id">
            <p><input type="submit" value="Yes, I am sure"/>
                <a href="index.php">No, I changed my mind</a></p>
        </form>
    _END;
?>
        </section>
        <?php } ?>
    </main>
    
</body>
<footer>
    2023 Blanchardstown Library Services, Contact: 01 188 5443
</footer>
</html>