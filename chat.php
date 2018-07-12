<?php
$db_name = "healthcare";
$mysql_username = "root";
$mysql_password = "";
$server_name = "localhost";
$conn = mysqli_connect($server_name, $mysql_username, $mysql_password,$db_name);
 $username=$_POST['username'];  
 $content =$_POST['content'] ;
$resl= mysqli_query($conn,"SELECT * FROM `patients` where Name='$username'");
		while ($row = $resl->fetch_assoc()) {
		$doctor=$row['Doctor'];}
		//echo $doctor;
$res2= mysqli_query($conn,"SELECT * FROM `messages` where (Sender='$doctor' and Receiver='$username') or (Sender='$username' and Receiver='$doctor') ");
		
		while ($row = $res2->fetch_assoc()) {
			if($row['num']>=0)
		$index=$row['num'];
	//echo $row['num'];
		}
		$index++;
		//echo $index;
$sqll = "INSERT INTO `messages` (`num`, `Sender`, `Receiver`, `Content` ) VALUES ('$index','$username','$doctor','$content')";
        if ($conn->query($sqll) === TRUE) {
			$res3= mysqli_query($conn,"SELECT * FROM `messages` where (Sender='$doctor' and Receiver='$username') or (Sender='$username' and Receiver='$doctor') ORDER BY `messages`.`Time` DESC");

			while ($row = $res3->fetch_assoc()) {
	
		echo "|success|".$row['Time']."|".$row['num']."|";
		break;
	} 
		}


else echo "errrijflk";






?>