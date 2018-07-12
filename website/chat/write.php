<?php
	session_start();
	if(!isset($_SESSION[`name`]))
{
	header('Location: ./index.php');
	
}?>
<?php
$db_name = "healthcare";
$mysql_username = "root";
$mysql_password = "";
$server_name = "localhost";
$conn = mysqli_connect($server_name, $mysql_username, $mysql_password,$db_name);
//$doctor==$_SESSION[`name`];
//$patient='K511';
$user=$_SESSION[`name`];
//echo$user;
//get user-input from url
$username=substr($_GET['username'], 0, 32);
$text=substr($_GET['text'], 0, 128);

//$_SESSION[`pname`]=$username;
//escaping is extremely important to avoid injections!
$nameEscaped = htmlentities(mysqli_real_escape_string($conn,$username)); //escape username and limit it to 32 chars
$textEscaped = htmlentities(mysqli_real_escape_string($conn, $text)); //escape text and limit it to 128 chars
//echo $nameEscaped;
$res2= mysqli_query($conn,"SELECT * FROM `messages` where (Sender='$user' and Receiver='$nameEscaped') or (Sender='$nameEscaped' and Receiver='$user') ORDER BY `messages`.`num` DESC ");
		
		while ($row = $res2->fetch_assoc()) {
			
		$index=$row['num'];
		//echo $index;
	    break;
		}
		$index++;
		//$index++;
		//echo $index;
//create query
$query="INSERT INTO messages (Receiver,Sender, Content,num) VALUES ('$nameEscaped','$user', '$textEscaped','$index')";
//execute query
if ($conn->real_query($query)) {
    //If the query was successful
    echo "Wrote message to db";
}else{
    //If the query was NOT successful
    echo "An error occurred";
    echo $conn->errno;
}

$conn->close();

?>