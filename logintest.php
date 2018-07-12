<?php 
$db_name = "healthcare";
$mysql_username = "root";
$mysql_password = "";
$server_name = "localhost";
$conn = mysqli_connect($server_name, $mysql_username, $mysql_password,$db_name);
$user_name = $_POST["username"];
$user_pass = $_POST["password"];
$mysql_qry = "select * from users where username like '$user_name' and password like '$user_pass';";
$result = mysqli_query($conn ,$mysql_qry);
if(mysqli_num_rows($result) > 0) {
	$res= mysqli_query($conn,"SELECT * FROM `users` where username='$user_name'");
	while ($row = $res->fetch_assoc()) {
	//$sql="select First_name,Last_name from users where username=$user_name";
echo "|success|".$row['First_name']."|".$row['Last_name']."|".$row['username']."|".$row['Phone']."|".$row['Birth_Date']."|";
}}
else {
echo "|not succesful|";
}

?>
 

