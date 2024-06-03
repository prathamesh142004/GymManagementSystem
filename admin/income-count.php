<?php

$servername = "localhost";
$uname = "root";
$pass = "";
$port = 3306;
$db = "gymnsb";

// Establishing connection to the database
$conn = mysqli_connect($servername, $uname, $pass, $db, $port);

// Check connection
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

// SQL query to calculate the sum of 'amount' column
$sql = "SELECT SUM(amount) AS totalAmount FROM members";

// Execute the query
$amountsum = mysqli_query($conn, $sql) or die(mysqli_error($conn));

// Fetch the result row
$row_amountsum = mysqli_fetch_assoc($amountsum);

// Echo the sum of 'amount' column
echo "Total Amount: " . $row_amountsum['totalAmount'];

// Close the database connection
mysqli_close($conn);
?>
