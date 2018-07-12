<?php
	$db_name = "healthcare";
	$mysql_username = "root";
	$mysql_password = "";
	$server_name = "localhost";
	$conn = mysqli_connect($server_name, $mysql_username, $mysql_password,$db_name);
    $user=$_POST['username'];  
	$pass =$_POST['password'] ;
	$fname=$_POST['fname'];	
	$lname=$_POST['lname'];
	$phone=$_POST['phone'];
	$type=$_POST['type'];
	$birth=$_POST['date'];
	//check if the username exists already in the database
	 $sql =$conn->prepare("SELECT * FROM `Users` WHERE username =? ");
	 $sql->bind_param("s",$user);
	 $sql->execute();
	 $sql->store_result();
	 if ($sql->num_rows == 0 && !empty($pass)) {
			
         
			//store the new username and password in the database
			$sqli = $conn->prepare("INSERT INTO `users` ( First_name,Last_name,username,Password,Phone,Birth_Date,type) VALUES ( ?,?,?,?,?,?,?)");
			$sqli->bind_param("ssssiss",$fname,$lname,$user,$pass,$phone,$birth,$type);
			$sqli->execute();
			
			//store new row for the patient in patients table
			$res= mysqli_query($conn,"SELECT * FROM `users` where username='$user'");
		while ($row = $res->fetch_assoc()) {
						$ID=$row['ID'];
					}
			$sqll = "INSERT INTO patients (ID,Name, Phone, Birth_Date) VALUES (?,?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sqll)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isis", $ID,$user,$phone, $birth);
            $stmt->execute();
			}
			
			$resl= mysqli_query($conn,"SELECT * FROM `users` where username='$user'");
		while ($row = $resl->fetch_assoc()) {
	//$sql="select First_name,Last_name from users where username=$user_name";
		echo "|success|".$row['First_name']."|".$row['Last_name']."|".$row['username']."|".$row['Phone']."|".$row['Birth_Date']."|";
	 }}
	 else{
		 
		 echo "|This username exist Try another|" ;
		 
	 }
	 
	 $conn->close();
?>