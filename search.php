<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
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
        <h1>Search for a Book</h1>
    </header>

    <main>
        <?php
        session_start();  
        require_once "connection.php";

        #checks if user is logged in before displaying search form
        if (!isset($_SESSION["info"])) 
        { ?>
        Please <a href="login.php">Log In</a> to search for a book.
        <?php
        }
        else {
            
            #if user is logged in, display search form when user has submitted a search
            if (isset($_POST['name']) && isset($_POST['author']) && isset($_POST['category'])){
            
            //user searches by title
            if ($_POST['name'] != "")
            {
                $n = $conn->real_escape_string($_POST['name']);

                // queries database for book title
                $sql1 = "SELECT ISBN, BookTitle, Author, Edition, Year, Reserved FROM book WHERE BookTitle LIKE '%$n%'";
                $result1 = $conn->query($sql1);

                // table that displays results
                if ($result1->num_rows > 0) 
                {
                    echo "<table style='margin-left: auto; margin-right: auto;' border='1'>";
                    echo "<tr><td><h2>Book Title </h2></td><td><h2>Author </h2></td><td><h2>Edition </h2></td><td><h2> Year </h2></td><td><h2>Availability </h2></td> </tr> ";

                    while($row = $result1->fetch_assoc()) 
                    {
                        echo "<tr><td>";
                        echo (htmlentities($row["BookTitle"]));
                        echo ("    </td><td>");
                        echo (htmlentities($row["Author"]));
                        echo ("    </td><td>");
                        echo (htmlentities($row["Edition"]));
                        echo ("    </td><td>");
                        echo (htmlentities($row["Year"]));
                        echo ("    </td><td>");
                        
                        #if book is not reserved, display reserve button
                        if (htmlentities($row["Reserved"]) == 'N')
                        {
                        echo ('<a href="reserve.php?ISBN='.htmlentities($row["ISBN"]).'"> Reserve </a>');
                        }
                        else {
                            echo ("Already reserved");
                        }
                    }
                    echo "</table>";
                    return;
                }
                else {
                    echo "0 results";
                }
                return;
            }

                        
                      
            //user searches by author
            else if ($_POST['author'] != "")
            {
                $a = $conn->real_escape_string($_POST['author']);

                // queries database for book author
                $sql2 = "SELECT ISBN, BookTitle, Author, Edition, Year, Reserved FROM book WHERE Author LIKE '%$a%'";
                $result2 = $conn->query($sql2);

                // displays results
                if ($result2->num_rows > 0) 
                {
                    echo "<table style='margin-left: auto; margin-right: auto;' border='1'>";
                    echo "<tr><td><h2>Book Title </h2></td><td><h2>Author </h2></td><td><h2>Edition </h2></td><td><h2>Year </h2></td><td><h2>Availability </h2></td> </tr> ";

                    while($row = $result2->fetch_assoc()) 
                    {
                        echo "<tr><td>";
                        echo (htmlentities($row["BookTitle"]));
                        echo ("    </td><td>");
                        echo (htmlentities($row["Author"]));
                        echo ("    </td><td>");
                        echo (htmlentities($row["Edition"]));
                        echo ("    </td><td>");
                        echo (htmlentities($row["Year"]));
                        echo ("    </td><td>");

                        if (htmlentities($row["Reserved"]) == 'N')
                        {
                        echo ('<a href="reserve.php?ISBN='.htmlentities($row["ISBN"]).'"> Reserve </a>');
                        }
                        else {
                            echo ("Already reserved");
                        }

                    }
                    return;
                }
                else {
                    echo "0 results";
                }
                return;
            }
                        
            else if ($_POST['category'] != "")
            {
                $c = $conn->real_escape_string($_POST['category']);

                // queries database for book category
                $sql3 = "SELECT ISBN, BookTitle, Author, Edition, Year, Category, Reserved FROM book WHERE Category = '$c'";
                $result3 = $conn->query($sql3);

                // table that displays results
                if ($result3->num_rows > 0) 
                {
                    echo "<table style='margin-left: auto; margin-right: auto;' border='1'>";
                    echo "<tr><td><h2>Book Title </h2></td><td><h2>Author </h2></td><td><h2>Edition </h2></td><td><h2>Year </h2></td><td><h2>Availability </h2></td> </tr> ";

                    while($row = $result3->fetch_assoc()) 
                    {
                        echo "<tr><td>";
                        echo (htmlentities($row["BookTitle"]));
                        echo ("    </td><td>");
                        echo (htmlentities($row["Author"]));
                        echo ("    </td><td>");
                        echo (htmlentities($row["Edition"]));
                        echo ("    </td><td>");
                        echo (htmlentities($row["Year"]));
                        echo ("    </td><td>");
                        
                        #if book is not reserved, display reserve button
                        if (htmlentities($row["Reserved"]) == 'N')
                        {
                            echo ('<a href="reserve.php?ISBN='.htmlentities($row["ISBN"]).'"> Reserve </a>');
                        }
                        else
                        {
                            echo ("Already reserved");
                        }
                    }
                }
                else {
                    echo "0 results";
                }
                return;
            }
        }
        echo "</tr></td>";
        ?>

    

    <section>
        <form method="post">
        <h2>Search by name:</h2>
        <input type="text" name="name">
        <h2>Search by author:</h2>
        <input type="text" name="author">
        <h2>Search by category:</h2>
        <select name="category" id="form">
        <?php

        #displays categories in dropdown menu
        $sqlSearch = "SELECT CategoryID, CategoryDescription from categories";
        $resultSearch = $conn->query($sqlSearch);
        if ($resultSearch->num_rows > 0) 
            {
                echo("<option value='-1'>Select Category</option>");
                while($row = $resultSearch->fetch_assoc()) 
                {
                    #stores category ID and description in variables
                    $category = htmlentities($row["CategoryDescription"]);
                    $catID = htmlentities($row["CategoryID"]);
                    echo("<option value='$catID' >$category</option>");
                }
            }
        ?>
            </select>
            <input type="submit" value="Search" class="search-button">
            </form>
        </section>
        <?php } ?>  
    </main>
</body>
<footer>
    2023 Blanchardstown Library Services, Contact: 01 188 5443
</footer>
</html>

