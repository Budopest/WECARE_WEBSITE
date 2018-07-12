<?php
$db_name = "healthcare";
$mysql_username = "root";
$mysql_password = "";
$server_name = "localhost";
$conn = mysqli_connect($server_name, $mysql_username, $mysql_password,$db_name);
$user = $_POST["username"];
		$string="|";
$resl= mysqli_query($conn,"SELECT * FROM `patients` where Name='$user'");
		while ($row = $resl->fetch_assoc()) {

		$string= "|" .$row['Medicines'].",".$row['Dose']."|";
		if($string=='|,|')
			echo "nothing";
	else	echo $string;


		}
?>