<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reserved</title>
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
        <h1>View My Reserved Books</h1>
    </header>

    <main>
        <?php
    session_start();
    require_once "connection.php";

    #checks if user is logged in
    if ( !isset($_SESSION["info"]) )
        { ?>
        Please <a href="login.php">Log In</a> to view your reserved books.
        <?php
        }
        else { ?>

    <section>
        <h1>My Reserved Books</h1> <br><br>
        <?php
        require_once "connection.php";
        
        #gets username from session
        $u = $conn->real_escape_string($_SESSION["info"]);
        
        #queries database for books reserved by user by joining book and reserved tables on ISBN and UserName columns 
        $sql = "SELECT book.ISBN, BookTitle, Author, Reserved, ReservedDate
        FROM book
        JOIN reserved 
        ON book.ISBN = reserved.ISBN
        WHERE reserved.UserName = '$u'";

        $result = $conn->query($sql);
        
        #displays table of reserved books
        if ($result->num_rows > 0) 
        {
            echo "<table style='margin-left: auto; margin-right: auto;' border='1'>";
            echo "<tr><td><h2>Book Title </h2></td><td><h2>Author </h2></td><td><h2>Reserved Date </h2></td><td><p><h2> Remove this Reservation </h2></hp></td></tr> ";

            while($row = $result->fetch_assoc()) 
            {
                echo "<tr><td>";
                echo (htmlentities($row["BookTitle"]));
                echo ("    </td><td>");
                echo (htmlentities($row["Author"]));
                echo ("    </td><td>");
                echo (htmlentities($row["ReservedDate"]));
                echo ("    </td><td>");
                echo ('<a href="remove.php?ISBN='.htmlentities($row["ISBN"]).'"> Remove Reservation</a>');
                echo ("    </td></tr>");
            }
            
        }
        else {
                echo "<h2>You have no reserved books</h2>";
            }
    ?>
    </section>
    <?php } ?>
    </main>   
</body>
<footer>
    2023 Blanchardstown Library, Contact: 01 188 5443
</footer>
</html>