<?php

$servername="localhost";
$uname="root";
$pass="";
$port=3306;
$db="gymnsb";

$conn=mysqli_connect($servername,$uname,$pass,$db,$port);

if(!$conn){
    die("Connection Failed");
}

$sql = "SELECT SUM( amount) FROM equipment";
        $amountsum = mysqli_query($conn, $sql) or die(mysqli_error($sql));
        $row_amountsum = mysqli_fetch_assoc($amountsum);
        $totalRows_amountsum = mysqli_num_rows($amountsum);
        echo $row_amountsum['SUM( amount)'];
?>