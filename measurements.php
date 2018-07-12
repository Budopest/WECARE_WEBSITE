<?php
$db_name = "healthcare";
$mysql_username = "root";
$mysql_password = "";
$server_name = "localhost";
$conn = mysqli_connect($server_name, $mysql_username, $mysql_password,$db_name);

$user = $_POST["username"];
$num=$_POST['id'];
$string=null;
$k=null;
if($num==='0'){
	
$ress= mysqli_query($conn,"SELECT * FROM `measurements` where Name='$user' ORDER BY `measurements`.`Time` ASC");
		while ($row = $ress->fetch_assoc()){
			$k++;
			$temp=$row['Tempreture'];
			$t_flag=$row['T-flag'];
			$heart=$row['HeartRate'];
			$h_flag=$row['Heart-flag'];
			$date=$row['time'];
			$version=$row['num'];
			
			$string= $string.",($temp,$t_flag,$heart,$h_flag,$date,$version)";
			
		}
		echo "|success|$k|$string|";
}
else {
		
$resl= mysqli_query($conn,"SELECT * FROM `measurements` where num>'$num' and Name='$user' ORDER BY `measurements`.`Time` ASC");
		while ($row = $resl->fetch_assoc()) {
			$k++;
			$temp=$row['Tempreture'];
			$t_flag=$row['T-flag'];
			$heart=$row['HeartRate'];
			$h_flag=$row['Heart-flag'];
			$date=$row['time'];
			$version=$row['num'];
			
			$string= $string.",($temp,$t_flag,$heart,$h_flag,$date,$version)";
		}
			echo "|success|$k|$string|";
}


?>
