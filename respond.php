<?php
session_start();
$db_name = "healthcare";
$mysql_username = "root";
$mysql_password = "";
$server_name = "localhost";
$conn = mysqli_connect($server_name, $mysql_username, $mysql_password,$db_name);

$username=$_POST['username']; 
$ID=$_POST['id'];
//$doctor=$_SESSION[`name`];
$string=null;

$res= mysqli_query($conn,"SELECT * FROM `patients` where Name='$username'");
		while ($row = $res->fetch_assoc()) {
		$doctor=$row['Doctor'];}
		
if($ID==='0'){
	$resll= mysqli_query($conn,"SELECT * FROM `messages` where num>'$ID' and (Sender='abdoqassem' and Receiver='$username') or (Sender='$username' and Receiver='abdoqassem') ");
	$k=0;
	while ($row = $resll->fetch_assoc()){
		$k++;
		if($username==$row['Sender'])
			$i="send";
		
		else $i="rec";
		$message=$row['Content'];
		$date=$row['Time'];
		$num=$row['num'];
		$string= $string.",($message,$date,$num,$i)";
	}
if($ID==='0'){
	echo "|success|$k|$string|";

	
}
	
	
}else{
$resl= mysqli_query($conn,"SELECT * FROM `messages` where num>'$ID' and Sender='$doctor' and Receiver='$username'");
$i=0;

while ($row = $resl->fetch_assoc()) {
	$i++;
	$message=$row['Content'];
	$date=$row['Time'];
	$num=$row['num'];
$string= $string.",($message,$date,$num)";}
echo "|success|$i|$string|";
}
?>


