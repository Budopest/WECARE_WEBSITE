<?php
$db_name = "healthcare";
$mysql_username = "root";
$mysql_password = "";
$server_name = "localhost";

$conn = mysqli_connect($server_name, $mysql_username, $mysql_password,$db_name);
$user_name = $_POST["username"];
//echo$user_name;
$sql= mysqli_query($conn,"SELECT * FROM `patients` where Name='$user_name'");
while ($row = $sql->fetch_assoc()) {

		$Doctor= $row['Doctor'];
		//echo $Doctor;
}
$sqll= mysqli_query($conn,"SELECT * FROM `users` where username='$Doctor'");
while ($row = $sqll->fetch_assoc()) {

		$Phone= $row['Phone'];
	//echo $Phone;
}
if(!empty($Doctor))
echo"|success|$Doctor|$Phone|";
else
echo"|You are not assigned to a doctor|";
?>