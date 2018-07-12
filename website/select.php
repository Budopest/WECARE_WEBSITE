<?php
session_start();
if(!isset($_SESSION[`name`]))
{
	header('Location: ./index.php');
	
}

?>

<?php
session_start();
// Include config file
//require_once 'config.php';
 $conn = new mysqli("localhost", "root", "", "healthcare");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$patient=$_POST['patient'];
//echo$patient;
	$sqli = "SELECT ID FROM patients where Name='$patient' ";

	$result = mysqli_query($conn, $sqli);
	/*if (!$check1_res) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}*/
	//$options = "";
	while($row2 = mysqli_fetch_array($result))
		{
		//echo$row2[0];
		$id=$row2[0];
		}
//echo $_SESSION[`name`];

$doctor=$_SESSION[`name`];
$sql = "UPDATE `patients` SET Doctor='$doctor' WHERE ID='$id'";
	if ($conn->query($sql) === TRUE) {
		 header("location: crud.php");
                exit();
	} else {
		echo "Error updating record: " . $conn->error;
	}

?>