<?php

$user=$_POST['username'];
$heart=$_POST['r'];
$rel=$_POST['rel'];
$temp=$_POST['t'];
$tel=$_POST['tel'];
$db_name = "healthcare";
$mysql_username = "root";
$mysql_password = "";
$server_name = "localhost";
$conn = new mysqli('localhost', 'root', '', 'healthcare');

$res= mysqli_query($conn,"SELECT * FROM `users` where username='$user'");
		while ($row = $res->fetch_assoc()) {
						$ID=$row['ID'];
						$type=$row['type'];
		}
	$sql =$conn->prepare("SELECT * FROM `measurements` WHERE Name =? ");
	 $sql->bind_param("s",$user);
	 $sql->execute();
	 $sql->store_result();

if($sql->num_rows == 0 && $type=="P")
							
	$num=0;
	else
		$num=$sql->num_rows;
	$num++;
	$s = "INSERT INTO `measurements` (`ID`,`num`,`Name`, `Tempreture`,`T-flag` , `HeartRate` , `Heart-flag` ,`Time`) VALUES ('$ID','$num','$user', '$temp' , '$tel' , '$heart' , '$rel' , CURRENT_TIMESTAMP)";

	if ($conn->query($s) === TRUE) {
		echo "Record updated successfully"."<br>";
	} else {
		echo "Error updating record: " . $conn->error;
	}
	



/*$ress= mysqli_query($conn,"SELECT * FROM `history` where Name='$user' ORDER BY `history`.`Time` ASC");
		if ($row = $ress->fetch_assoc()) {
						$oldest=$row['Time'];
				//	echo"$oldest";
						}*/

/*$sql1 = "UPDATE `history` SET Tempreture='$temp',Heart_Rate='$heart',T_flag='$tel',Heart_flag='$rel' WHERE Time='$oldest'";	
if ($conn->query($sql1) === TRUE) 
echo "Record updated successfully"."<br>";*/

$sql2 = "UPDATE `patients` SET Tempreture='$temp',Heart_Rate='$heart' WHERE Name='$user'";	
if ($conn->query($sql2) === TRUE) 
echo "Record updated successfully"."<br>";


?>