<?php
	$username = $password = $fname = $lname = $Phone = $date = "";
	$username_err = $password_err = $fname_err = $lname_err = $birthday_err =$Phone_err = $date_err = "";   	
$conn = new mysqli("localhost", "root", "", "healthcare");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
	if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    if(empty(trim($_POST['username']))){
        $username_err = "Please enter a username.";
    } else{
//check if the username exists already in the database
	 $sql =$conn->prepare("SELECT * FROM `Users` WHERE username =? ");
	 $sql->bind_param("s",$user);
	 $sql->execute();
	 $sql->store_result();
	 if ($sql->num_rows != 0) {
             $username_err = "This username is already taken.";
	 }	else 
	 {	$username = trim($_POST["username"]);}
			
	 }
	 
	 // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }
	// Validate fname
    if(empty(trim($_POST['fname']))){
        $fname_err = "Please enter a first name.";     
    } elseif(strlen(trim($_POST['fname'])) < 3){
        $fname_err = "first name must have at least 3 characters.";
    } else{
        $fname = trim($_POST['fname']);
    }
	// Validate lname
    if(empty(trim($_POST['lname']))){
        $lname_err = "Please enter a last name.";     
    } elseif(strlen(trim($_POST['lname'])) < 3){
        $lname_err = "last name must have at least 3 characters.";
    } else{
        $lname = trim($_POST['lname']);
    }
	 // Validate Phone
    if(empty($_POST['Phone'])){
        $Phone_err = "Please enter a Phone number.";     
    } elseif(!ctype_digit($_POST['Phone'])|| strlen(trim($_POST['Phone'])) < 8){
        $Phone_err = 'Please enter a valid Phone number.';
    } else{
        $Phone= $_POST['Phone'];
    }
	// Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($fname_err) && empty($lname_err) && empty($Phone_err)){
		$birth=$_POST['birthday'];
		$birthday=date_create($birth);
		$type=$_POST['type'];
		//echo $type;
		//sleep(5);
		if($type=="P")
			$type="P";
		else	$type="D";
		if($type=="P")
			{
				$sql = "INSERT INTO patients (Name, Phone, Birth_Date) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sis", $username,$Phone, $birth);
            $stmt->execute();
			}
			}
		$sqli = $conn->prepare("INSERT INTO `users` ( First_name,Last_name,username,Password,Phone,Birth_date,type) VALUES ( ?,?,?,?,?,?,?)");
			$sqli->bind_param("ssssiss",$fname,$lname,$username,$password,$Phone,$birth,$type);
			$sqli->execute();
			if($sqli){
				if($type=="D")
				{session_start();
				$_SESSION[`name`]=$username;
                // Redirect to login page
                header("location: home.php");}
				//add 10 rows in history table
           /*  elseif($type=="P"){
				session_start();


			$_SESSION[`pname`]=$username;
			header("location: phome.php");
			}*/
			else
                echo "Something went wrong. Please try again later.";
            }
	
		 
	 }
	

$conn->close();
	}		
	
?>
