<?php
	session_start();
	if(isset($_SESSION[`name`]))
{
	header('Location: ./home.php');
	
}

?>
<?php
$conn = new mysqli("localhost", "root", "", "healthcare");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
	$m=$n=$o="";
	$sql="SELECT * FROM `feedback` ORDER BY `feedback`.`time` DESC";
	if($result = mysqli_query($conn, $sql)){
     while($row = mysqli_fetch_array($result)){
		 if($m=='1')
			 break;
		 $feedback=$row['feedback'];
		 $owner=$row['username'];
		 break;
		 $m++;
}
	}
	if($result2 = mysqli_query($conn, $sql)){
     while($row = mysqli_fetch_array($result2)){
		 if($n=='2')
			 break;
		 $feedback2=$row['feedback'];
		 $owner2=$row['username'];
		 $n++;
}
	}
	if($result3 = mysqli_query($conn, $sql)){
     while($row = mysqli_fetch_array($result3)){
		 if($o=='3')
			  break;
		 $feedback3=$row['feedback'];
		 $owner3=$row['username'];
		$o++;
}
	}
	
	$username = $password = $fname = $lname = $Phone = $date = "";
	$username_err = $password_err = $fname_err = $lname_err = $birthday_err =$Phone_err = $date_err = "";   	

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
		
		$sqli = $conn->prepare("INSERT INTO `users` ( First_name,Last_name,username,Password,Phone,Birth_date,type) VALUES ( ?,?,?,?,?,?,?)");
			$sqli->bind_param("ssssiss",$fname,$lname,$username,$password,$Phone,$birth,$type);
			$sqli->execute();
			if($type=="P")
			{
				$res= mysqli_query($conn,"SELECT * FROM `users` where username='$username'");
		while ($row = $res->fetch_assoc()) {
						$ID=$row['ID'];
					}
				$sql = "INSERT INTO patients (ID,Name, Phone, Birth_Date) VALUES (?,?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isis", $ID,$username,$Phone, $birth);
            $stmt->execute();
			}
			}
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
                echo "The site is not ready for the patients.";
            }
	
		 
	 }
	
	
	
	

$conn->close();
	}		
	
?>

<!DOCTYPE html>
<html>
<head>
	<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<!-- meta character set -->
		<meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css"">
	<link rel="stylesheet" type="text/css" href="style.css"/>
	
</head>

<body>

	<header id="header" id="home">
	<div class="container">
		  		<div class=" row">
				
				<div class="col-md-6 col-sm-3 col-xs-3">
		<div class="social_links">
<ul>
  <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
  <li><a href="#"><i class="fab fa-youtube"></i></a></li>
  <li><a href="#"><i class="fab fa-twitter"></i></a></li>
  <li><a href="#"><i class="fab fa-instagram"></i></a></li>
</ul>


    </div>
				</div>
			
				<div class="col-md-2 col-sm-4 col-xs-1 ml-auto ">
  <!-- Button trigger modal -->
  <button  type="button" class="btn btn-primary login_btn" data-toggle="modal" data-target="#exampleModalCenter">
     Login
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div class="img_logo">
                <img src="./img/logo.png" alt="">
            </div>
 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form  action="login.php" method="post">
                <div class="form-group">
                <label for="Username">Username:</label>
                <input type="text" class="form-control" name="username" placeholder="Username">
              </div>

              <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-default">Login</button>
          </div>
		  </form>
        </div>
      </div>
    </div>
		  			</div>	  			
					
					
					<div class="col-lg-1 col-md-2 col-sm-2 col-xs-2  ">
					
					  <!-- Button trigger modal -->
  <button  type="button" class="btn btn-success signup_btn" data-toggle="modal" data-target="#exampleModalCenterr">
     Signup
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenterr" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div class="img_logo">
                <img src="./img/logo.png" alt="">
            </div>
 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			
			<div class="form-group <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
                <label>First Name</label>
                <input type="text" name="fname"class="form-control" value="<?php echo $fname; ?>">
                <span class="help-block"><?php echo $fname_err; ?></span>
            </div>  
			<div class="form-group <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?>">
                <label>Last Name</label>
                <input type="text" name="lname"class="form-control" value="<?php echo $lname; ?>">
                <span class="help-block"><?php echo $lname_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            
			<div class="form-group <?php echo (!empty($Phone_err)) ? 'has-error' : ''; ?>">
                <label>Phone</label>
                <input type="text" name="Phone" class="form-control" value="<?php echo $Phone; ?>">
                <span class="help-block"><?php echo $Phone_err; ?></span>
            </div>
			<div class="form-group <?php echo (!empty($birthday_err)) ? 'has-error' : ''; ?>">
                <label>Birthday</label>
                <input type="date" name="birthday" class="form-control" value="<?php echo $birthday; ?>">
                <span class="help-block"><?php echo $birthday_err; ?></span>
            </div>
			<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Type</label>
              <td>  <input type="radio" name="type"  value="D"/>Doctor</td>
              <td>  <input type="radio" name="type"  value="P"/>Patient</td>
            </div>
       
          <div class="modal-footer">

                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
                   </form>         
			</div>
        </div>
      </div>
    </div>
		  			</div>	  			
					
					
					
					
					
					
					
					
					
        </div>
  </header>	
  





	
<!-- Start navbar -->	
<nav class="navbar navbar-expand-lg navbar-light ">

<div class="container">
    <a class="navbar-brand" href="#"><img class="img-fluid" src="./img/logo.png" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse " id="navbarSupportedContent">
  
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="services.php">Services</a>
      </li>
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          More
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="products.php">Our Products</a>
      </li>
	
	  
    </ul>
   
  </div>
</div>



</nav>
<!-- end navbar -->
<!-- Start carousel -->

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item carousel-item-image active">
        <img class="d-block w-100" src="./img/hero1.jpg" alt="First slide">
        <div class="overlay">
          <div class="content">
              <h1>EECE-CUFE healthcare project <span><strong>We Care</strong></span></h1>
              <p>An IOT medical healthcare system to monitor the patients' health</p>
          </div>
    
        </div>
      </div>
      <div class="carousel-item carousel-item-image ">
        <img class="d-block w-100" src="./img/2.jpg" alt="Second slide">
  
            <div class="overlay">
                <div class="content">
               <h1>We Care For You</h1>
              <p>High quality care makes a difference</p></div>
        </div>
  
      </div>
      <div class="carousel-item carousel-item-image ">
        <img class="d-block w-100" src="./img/about1.jpg" alt="Third slide">
        <div class="overlay">
          <div class="content">
              <h1>EECE-CUFE healthcare project <span><strong>We Care</strong></span></h1>
              <p>An IOT medical healthcare system to monitor the patients' health</p>
          </div>
    
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>



<!-- START SERVICES section -->
<SECTION class="services text-center">
<div class="container">
<div class="row">
  <div class="col-md-12">
    <div class="services_header">
        <h1>Our Services</h1>
    </div>

  </div>
</div>



<div class="row">

<div class="col-lg-3 col-md-6">
  <div class="service_content">
      <i class="fas fa-user-md"></i>
      <h5>24/7 Care</h5>
  </div>

</div>

<div class="col-lg-3 col-md-6">
  <div class="service_content">
      <i class="fas fa-briefcase-medical"></i>
      <h5>Doctors will describe your medicines</h5>
  </div>

</div>

<div class="col-lg-3 col-md-6">
  <div class="service_content">
      <i class="fab fa-android"></i>
      <h5>An andriod application for you</h5>
  </div>

</div>

<div class="col-lg-3 col-md-6">
  <div class="service_content">
      <i class="far fa-comments"></i>
      <h5>You can chat with your doctor</h5>
  </div>

</div>

</div>
</div>
</section>

<!-- END SERVICES section -->

<!-- START testimon section -->
<section class="testimon text-center">
<div class=="container">
<h1>What our clients say?</h1>
<div id="slide" class="carousel slide" data-ride="carousel">
  
  <div class="carousel-inner">
   
    <div class="carousel-item active">
    <p class="lead"><?php echo $feedback;?></p>
	<span> <?php echo $owner;?></span>
  </div>
    
    <div class="carousel-item">
	 <p class="lead"><?php echo $feedback2;?></p>
	 <span> <?php echo $owner2;?></span>
    </div>
	
    <div class="carousel-item">
	 <p class="lead"><?php echo $feedback3;?></p>
	 <span> <?php echo $owner3;?></span>
    </div>
  </div>
 <ol class="carousel-indicators">
    <li data-target="#slide" data-slide-to="0" class="active"></li>
    <li data-target="#slide" data-slide-to="1"></li>
    <li data-target="#slide" data-slide-to="2"></li>
  </ol>
</div>

</div>
</section>

<!-- END testimon section -->

<!-- START FOOTER section -->
<section class="footer">
<div class="container">
<div class="row">
<div class="col-lg-4">
<h3>Site Map</h3>
<ul class="list-unstyled">
<li><a href="index.php">Home</a></li>
<li><a href="about.php">About</a></li>
<li><a href="services.php">Services</a></li>
<li><a href="products.php">Our Products</a></li>
<li><a href="contact.php">Contact us</a></li>
</ul>
<ul class="list-unstyled social">
<li><a href="https://www.facebook.com" class="fab fa-facebook" ></a></li>
<li><a href="https://twitter.com" class="fab fa-twitter"></a></li>
<li><a href="https://youtube.com" class="fab fa-youtube"></a></li>
<li><a href="https://instagram.com" class="fab fa-instagram"></a></li>
</ul>
</div>

<div class="col-lg-4">
<h3>Latest News</h3>
   <ul class=" list-unstyled">
    <li><a href="#">News &amp; Press Releases</a></li>
    <li><a href="#">Health Care Professional News</a></li>
    <li><a href="#">Events &amp; Conferences</a></li>
    </ul>
</div>

<div class="col-lg-4">
<h3>Location &amp; Contact</h3>
     <p >134 Gam3a St, Giza, Egypt</p>

     <h4 class="text-uppercase mb-3 h6 text-white">Email</h5>
     <p class="mb-3"><a href="mailto:info@yourdomain.com">info@wecare.com</a></p>
            
     <h4 class="text-uppercase mb-3 h6 text-white">Phone</h5>
      <p>+02 24 435 353</p>

      </div>
	  
</div>
<div class="row pt-md-3 element-animate">
          <div class="col-md-12">
            <hr class="border-t">
          </div>
          <div class="col-md-6 col-sm-12 copyright">
            <p>&copy; 2018 We Care. Designed &amp; Developed by EECE 2018</p>
          </div>

</div>
</div>
</section>
<!-- END FOOTER section -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="js/plugins.js"></script>
</body>
</html>