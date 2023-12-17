<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blanchardstown Library</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <header>
        <h1> Welcome to Blanchardstown Library</h1>
    </header>

    <main>
        <?php
            session_start();
            require_once "connection.php";

            #checks if user is logged in
            if ( !isset($_SESSION["info"]))
                { ?>
                Please <a href="login.php">Log In</a> to proceed.
                <?php
                }
                #if user is logged in, display home page
                else {
                $name = isset($_SESSION["info"]) ? $_SESSION["info"] : '';
        ?>
        
        <div id="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="search.php">Search for a Book</a></li>
                <li><a href="view.php">View My Reserved Books</a></li>
                <li><a href="logout.php">Log out</a></li>
            </ul>
        </div>

        <section class="container">
            <h2> Welcome, <?php echo(htmlentities($name)); ?></h2>
            <p> You can now search for a book and reserve it. </p>
        </section>

        <section>
            <h2>Changes to our Library. Exciting times ahead!</h2>
            <p> We are thrilled to announce exciting changes to our library, ushering in a new era of possibilities and enrichment. In response to your feedback and evolving needs, we have curated an enhanced collection, expanded digital resources, and implemented user-friendly features. These improvements aim to provide you with an even more engaging and seamless library experience. </p>
            <h2> Opening Hours</h2>
            <p> Monday - Friday: 10am - 4pm</p>
            <p> Saturday: 10am - 2pm</p>
            <p> Sunday: Closed</p>
            <h2>Our Online Library Services</h2>
            <p> Our reservation system allows you to secure your copy, ensuring that your literary adventure awaits you, ready to be enjoyed at your convenience. Embrace 
                the convenience of browsing, searching, and reserving your preferred reads from the comfort of your own space, as our 
                online library opens new chapters in the joy of reading and learning. </p>    
        </section>
        <?php } ?>
    </main>   
</body>
<footer>
    2023 Blanchardstown Library Services, Contact: 01 188 5443
</footer> 
</html>