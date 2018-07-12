<?php
session_start();

// Create connection
$conn = new mysqli('localhost', 'root', '', 'healthcare');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} 
	$patient=$_SESSION[`name`];

	 $query = "SELECT * FROM `patients` where Doctor='$patient'";
	 $result2 = mysqli_query($conn, $query);

	$options = "";

while($row2 = mysqli_fetch_array($result2))
{
    $options = $options."<option>$row2[1]</option>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Measurement history</title>
	
    
   
</head>
<body>
									 
	<div id="chart-container">
	<canvas id="mycanvas"></canvas>
	
	</div>
<select class="form-group" name="userName" id="userName">
												<?php echo $options;?>
														</select>

<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>

<script type="text/javascript" src="js/Chart.min.js"></script>

<script type="text/javascript" src="js/temp.js"></script>


</body>
</html>