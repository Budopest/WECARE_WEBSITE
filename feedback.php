<?php
$db_name = "healthcare";
$mysql_username = "root";
$mysql_password = "";
$server_name = "localhost";

$conn = mysqli_connect($server_name, $mysql_username, $mysql_password,$db_name);
$feedback = $_POST["feedback"];
$username = $_POST["username"];


$sql="insert into `feedback` (`username`,`feedback`) values ('$username', '$feedback')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
}