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
$doctor=$_SESSION[`name`];
//$username=$_SESSION[`pname`];
//echo$doctor;
$resl= mysqli_query($conn,"SELECT * FROM `messages` where Sender='$doctor' ORDER BY `messages`.`time` DESC");
		while ($row = $resl->fetch_assoc()) {
			$patient=$row['Receiver'];
			break;
		}


//$patient='K511';
$query="SELECT * FROM `messages` where (Sender='$doctor' and Receiver='$patient') or (Sender='$patient' and Receiver='$doctor') ORDER BY `messages`.`num` ASC";
//execute query
if ($conn->real_query($query)) {
    //If the query was successful
    $res = $conn->use_result();

    while ($row = $res->fetch_assoc()) {
        $username=$row["Sender"];
        $text=$row["Content"];
        $time=date('G:i', strtotime($row["Time"])); //outputs date as # #Hour#:#Minute#

     if($username=="$doctor")
        echo "<p class='left'>$time | $username: $text</p>\n";
	   else echo "<p class='right'>$time | $username: $text</p>\n";
    }
}else{
    //If the query was NOT successful
    echo "An error occured";
    echo $conn->errno;
}

$conn->close();
?>