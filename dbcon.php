<?php

// $conn = new PDO('mysql:host=localhost;dbname=socialdb', 'root', '');

$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "socialdb";
// Create connection
$conn = mysqli_connect($hostname, $username, $password, $databaseName);
// Check connection
if (!$conn) {
    die("Unable to Connect database: " . mysqli_connect_error());
}

?>