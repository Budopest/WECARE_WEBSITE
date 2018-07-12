
<?php
header('content-type: application/json');
$conn = new mysqli("localhost", "root", "", "healthcare");
		// Check connection
	
	$query= "select `time`,`pressure` from `moremeasure` where `Name`='Ah_khaled'";
	
$result = mysqli_query($conn, $query);

$data = array();
foreach ($result as $row){
	$data[]=$row;
}



print json_encode ($data);

//header("location: linegraph.html");

?>
