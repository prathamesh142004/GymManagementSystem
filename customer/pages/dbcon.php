<?php

$host = 'localhost';
$port = 3307; // Your MySQL server port
$user = 'root';
$password = '';
$database = 'gymnsb';

$conn = new mysqli($host, $user, $password, $database, $port);

// Check the connection
if ($conn->connect_error) {
    die("Could not connect to MySQL: " . $conn->connect_error);
}


?>


