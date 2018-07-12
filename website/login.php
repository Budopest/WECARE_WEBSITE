    <?php
	$user=($_POST['username']);  
	$pass =($_POST['password']) ; 
	
	// Create connection
$conn = new mysqli("localhost", "root", "", "healthcare");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['username'])&& isset($_POST['password'])){
$statement = $conn->prepare ("SELECT * FROM `users` WHERE (username =? AND Password =?);");
if($statement)
{$statement->bind_param("ss",$user,$pass);
$statement->execute();
$statement->store_result();
if ($statement->num_rows > 0) {
                       session_start();
					   $_SESSION[`name`]=$user;
						$sql=("select type from users where username='$user'");
						$result = mysqli_query($conn, $sql);
						while($row2 = mysqli_fetch_array($result))
							if($row2[0]=="D")
                        header('Location: ./home.php');
							else
						header('Location: ./phome.php');		
                        exit();
						

   } else {
               
			   echo 'Error logged in, The username or the password is not correct, Try agian please';
  }

}
}
else echo"Please insert a Username and a Passsword";

$conn->close();
?>