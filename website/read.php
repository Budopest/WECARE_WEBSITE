<?php
session_start();
if(!isset($_SESSION[`name`]))
{
	header('Location: ./index.php');
	
}

?>
<?php
// Check existence of ID parameter before processing further
if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){
    // Include config file
$conn = new mysqli("localhost", "root", "", "healthcare");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    
    // Prepare a select statement
    $sql = "SELECT * FROM patients WHERE ID = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_ID);
        
        // Set parameters
        $param_ID = trim($_GET["ID"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve indivIDual field value
                $username = $row["Name"];
				$tempreture = $row["Tempreture"];
				$heartrate = $row["Heart_Rate"];
				$heartrate = $row["Pressure"];
				$heartrate = $row["Diabetes"];
				$illness = $row["illness"];
				$medicines = $row["Medicines"];
				$heartrate = $row["Dose"];
                $Phone = $row["Phone"];
                $Birth_Date = $row["Birth_Date"];
				$History = $row["History"];
            } else{
                // URL doesn't contain valID ID parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($conn);
} else{
    // URL doesn't contain ID parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Patient</title>
	 <link rel="stylesheet" href="css/bootstrap.css">
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
   
	<link rel="stylesheet" type="text/css" href="style.css"/>
    
    <style type="text/css">
      
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
   
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
<div class="col-lg-1 col-md-2 col-sm-4 col-xs-1 ml-auto ">
  <!-- Button trigger modal -->
 <a href="logout.php" class="btn btn-danger pull-right">Logout</a>

    </div>
				</div>
				</div>
				
			

  </header>	
  





	
<!-- Start navbar -->	
<nav class="navbar navbar-expand-lg navbar-light " id="navbarhome">

<div class="container">
    <a class="navbar-brand" href="#"><img class="img-fluid" src="./img/logo.png" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse " id="navbarSupportedContent">
  
    <ul class="navbar-nav ml-auto">
      <li class="nav-item ">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
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

<section class="home" id="crud">

 <div class="container" id="crud">
           <div class="page-header">
                        <h1>View Details</h1>
                    </div>
					<div class="row">
					<div class="col-lg-4">
                    <div class="form-group">
                        <label>Patient Name</label>
                        <p class="form-control-static"><?php echo $row["Name"]; ?></p>
                    </div></div>
					<div class="col-lg-4">
					<div class="form-group">
                        <label>Tempreture</label>
                        <p class="form-control-static"><?php echo $row["Tempreture"]; ?></p>
                    </div></div>
					<div class="col-lg-4">
					<div class="form-group">
                        <label>Heart Rate</label>
                        <p class="form-control-static"><?php echo $row["Heart_Rate"]; ?></p>
                    </div></div>
					<div class="col-lg-4">
					<div class="form-group">
                        <label>Pressure</label>
                        <p class="form-control-static"><?php echo $row["Pressure"]; ?></p>
                    </div></div>
					<div class="col-lg-4">
					<div class="form-group">
                        <label>Diabetes</label>
                        <p class="form-control-static"><?php echo $row["Diabetes"]; ?></p>
                    </div></div>
					<div class="col-lg-4">
					<div class="form-group">
                        <label>Illness</label>
                        <p class="form-control-static"><?php echo $row["illness"]; ?></p>
                    </div></div>
					<div class="col-lg-4">
					<div class="form-group">
                        <label>Medicines</label>
                        <p class="form-control-static"><?php echo $row["Medicines"]; ?></p>
                    </div></div>
					<div class="col-lg-4">
					<div class="form-group">
                        <label>Dose</label>
                        <p class="form-control-static"><?php echo $row["Dose"]; ?></p>
                    </div></div>
					<div class="col-lg-4">
                    <div class="form-group">
                        <label>Phone</label>
                        <p class="form-control-static"><?php echo $row["Phone"]; ?></p>
                    </div></div>
					<div class="col-lg-4">
                    <div class="form-group">
                        <label>Birth_Date</label>
                        <p class="form-control-static"><?php echo $row["Birth_Date"]; ?></p>
                    </div></div>
					<div class="col-lg-12">
					<div class="form-group">
                        <label>History</label>
                        <p class="form-control-static"><?php echo $row["History"]; ?></p>
                    </div></div>
					<div class="col-lg-4">
                    <p><a href="crud.php" class="btn btn-primary">Back</a></p>
       
    </div>
	</div>
	</div>
	</div>



<div class="list-group ml-auto">
  <a href="crud.php" class="list-group-item list-group-item-action active">
     Patients' Measurements
  </a>
  <a href="images.php" class="list-group-item list-group-item-action">Patients' Images</a>
  <a href="./chat" class="list-group-item list-group-item-action">Chat Now</a>
  <a href="create.php" class="list-group-item list-group-item-action">Add new patient</a>
  <a href="addexisting.php" class="list-group-item list-group-item-action">Add registered patient</a>
</div>
</section>















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
</body>
</html>