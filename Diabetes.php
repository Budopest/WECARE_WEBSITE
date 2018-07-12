<?php
$db_name = "healthcare";
$mysql_username = "root";
$mysql_password = "";
$server_name = "localhost";
$conn = mysqli_connect($server_name, $mysql_username, $mysql_password,$db_name);
 $username=$_POST['username'];  
 $Diabetes =$_POST['diabetes'] ;
 
 $res= mysqli_query($conn,"SELECT * FROM `users` where username='$username'");
		while ($row = $res->fetch_assoc()) {
						$ID=$row['ID'];
						$type=$row['type'];
		}
	$sql =$conn->prepare("SELECT * FROM `diabetes` WHERE Name =? ");
	 $sql->bind_param("s",$username);
	 $sql->execute();
	 $sql->store_result();

if($sql->num_rows == 0)
							
	$num=0;
	else
		$num=$sql->num_rows;
	$num++;
	
$sqll = "insert into `diabetes` (`id`,`num`,`Name`,`diabetes`, `time`) values ('$ID',' $num', '$username', '$Diabetes', CURRENT_TIMESTAMP)";
if ($conn->query($sqll) === TRUE) 
echo "Record updated successfully"."<br>";

$sql2 = "UPDATE `patients` SET Diabetes='$Diabetes' WHERE Name='$username'";	
if ($conn->query($sql2) === TRUE) 
echo "Record updated successfully"."<br>";
?>