<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "library_db";

#create connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

#check connection
if ($conn->connect_error) 
{
    die("Failed to connect: " . $conn->connect_error);
}
?>