<?php

$servername="localhost";
$uname="root";
$pass="";
$port=3307;
$db="gymnsb";

$conn=mysqli_connect($servername,$uname,$pass,$db,$port);

if(!$conn){
    die("Connection Failed");
}

$sql = "SELECT * FROM announcements";
                $query = $conn->query($sql);

                echo "$query->num_rows";
?>