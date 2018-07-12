<?php
session_start();
if(!isset($_SESSION[`name`]))
{
	header('Location: ./index.php');
	
}

?>
<?php
// Include config file
$conn = new mysqli("localhost", "root", "", "healthcare");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Define variables and initialize with empty values
$username = $tempreture = $heartrate = $Pressure =$Diabetes =$illness = $medicines = $Dose =$Phone = $Birth_Date = "";
$username_err = $tempreture_err = $heartrate_err = $Pressure_err =$Diabetes_err =$illness_err = $medicines_err = $Dose_err = $Phone_err = $Birth_Date_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["ID"]) && !empty($_POST["ID"])){
    // Get hIDden input value
    $ID = $_POST["ID"];
    
    // ValIDate username
    $input_username = trim($_POST["username"]);
    if(empty($input_username)){
        $username_err = "Please enter a username.";
    } /*elseif(!filter_var(trim($_POST["username"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $username_err = 'Please enter a valID username.';
    } */else{
        $username = $input_username;
    }
	  // Validate tempreture
    $input_tempreture = trim($_POST["tempreture"]);
    if(empty($input_tempreture)){
        $tempreture_err = 'Please enter a tempreture.';     
    } else{
        $tempreture = $input_tempreture;
    }
	  // Validate heartrate
    $input_heartrate = trim($_POST["heartrate"]);
    if(empty($input_heartrate)){
        $heartrate_err = 'Please enter an heartrate.';     
    } else{
        $heartrate = $input_heartrate;
    }
	// Validate Pressure
    $input_Pressure = trim($_POST["Pressure"]);
    if(empty($input_Pressure)){
        $Pressure_err = 'Please enter a presssure.';     
    } else{
        $Pressure = $input_Pressure;
    }
	// Validate Diabetes
    $input_Diabetes = trim($_POST["Diabetes"]);
    if(empty($input_Diabetes)){
        $Diabetes_err = 'Please enter a Diabetes.';     
    } else{
        $Diabetes = $input_Diabetes;
    }
      // Validate illness
    $input_illness = trim($_POST["illness"]);
    if(empty($input_illness)){
        $illness_err = 'Please enter an illness.';     
    } else{
        $illness = $input_illness;
    }
	  // Validate medicines
    $input_medicines = trim($_POST["medicines"]);
    if(empty($input_medicines)){
        $medicines_err = 'Please enter a medicine.';     
    } else{
        $medicines = $input_medicines;
    }
	// Validate dose
    $input_Dose = trim($_POST["Dose"]);
    if(empty($input_Dose)){
        $Dose_err = 'Please enter a dose.';     
    } else{
        $Dose = $input_Dose;
    }
    
    // ValIDate Phone 
    $input_Phone = trim($_POST["Phone"]);
    if(empty($input_Phone)){
        $Phone_err = 'Please enter an Phone.';     
    } else{
        $Phone = $input_Phone;
    }
    
    // ValIDate Birth_Date
    $input_Birth_Date = trim($_POST["Birth_Date"]);
    if(empty($input_Birth_Date)){
        $Birth_Date_err = "Please enter the Birth_Date amount.";     
    } //elseif(!ctype_digit($input_Birth_Date)){
        //$Birth_Date_err = 'Please enter a positive integer value.';
     else{
        $Birth_Date = $input_Birth_Date;
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($tempreture_err) && empty($heartrate_err) && empty($illness_err) && empty($medicines_err) && empty($Phone_err) && empty($Birth_Date_err) && empty($Pressure_err) && empty($Diabetes_err) && empty($Dose_err)){
        // Prepare an insert statement
        $sql = "UPDATE patients SET Name=?, Tempreture=? , Heart_Rate=? ,Pressure=?, Diabetes=?, illness=? , Medicines=? ,Dose=?, Phone=?, Birth_Date=? WHERE ID=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "siisssssisi", $param_username, $param_tempreture, $param_heartrate, $param_Pressure,$param_Diabetes,$param_illness, $param_medicines ,$param_Dose, $param_Phone, $param_Birth_Date, $param_ID);
            
            // Set parameters
            $param_username = $username;
			$param_tempreture = $tempreture;
			$param_heartrate = $heartrate;
			$param_Pressure = $Pressure;
			$param_Diabetes = $Diabetes;
			$param_illness = $illness;
			$param_medicines = $medicines;
			$param_Dose = $Dose;
            $param_Phone = $Phone;
            $param_Birth_Date = $Birth_Date;
            $param_ID = $ID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: crud.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
} else{
    // Check existence of ID parameter before processing further
    if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){
        // Get URL parameter
        $ID =  trim($_GET["ID"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM patients WHERE ID = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_ID);
            
            // Set parameters
            $param_ID = $ID;
            
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
					$Pressure = $row["Pressure"];
					$Diabetes = $row["Diabetes"];
					$illness = $row["illness"];
					$medicines = $row["Medicines"];
					$Dose= $row["Dose"];
                    $Phone = $row["Phone"];
                    $Birth_Date = $row["Birth_Date"];
                } else{
                    // URL doesn't contain valID ID. Redirect to error page
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
    }  else{
        // URL doesn't contain ID parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Patient information</title>
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label>Patient Name</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                            <span class="help-block"><?php echo $username_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($tempreture_err)) ? 'has-error' : ''; ?>">
                            <label>tempreture</label>
                            <input type="text" name="tempreture" class="form-control" value="<?php echo $tempreture; ?>">
                            <span class="help-block"><?php echo $tempreture_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($heartrate_err)) ? 'has-error' : ''; ?>">
                            <label>Heartrate</label>
                            <input type="text" name="heartrate" class="form-control" value="<?php echo $heartrate; ?>">
                            <span class="help-block"><?php echo $heartrate_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($Pressure_err)) ? 'has-error' : ''; ?>">
                            <label>Pressure</label>
                            <input type="text" name="Pressure" class="form-control" value="<?php echo $Pressure; ?>">
                            <span class="help-block"><?php echo $Pressure_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($Diabetes_err)) ? 'has-error' : ''; ?>">
                            <label>Diabetes</label>
                            <input type="text" name="Diabetes" class="form-control" value="<?php echo $Diabetes; ?>">
                            <span class="help-block"><?php echo $Diabetes_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($illness_err)) ? 'has-error' : ''; ?>">
                            <label>Illness</label>
                            <input type="text" name="illness" class="form-control" value="<?php echo $illness; ?>">
                            <span class="help-block"><?php echo $illness_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($medicines_err)) ? 'has-error' : ''; ?>">
                            <label>Medicines</label>
                            <input type="text" name="medicines" class="form-control" value="<?php echo $medicines; ?>">
                            <span class="help-block"><?php echo $medicines_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($Dose_err)) ? 'has-error' : ''; ?>">
                            <label>Dose</label>
                            <input type="text" name="Dose" class="form-control" value="<?php echo $Dose; ?>">
                            <span class="help-block"><?php echo $Dose_err;?></span>
                        </div>
					
                        <div class="form-group <?php echo (!empty($Phone_err)) ? 'has-error' : ''; ?>">
                            <label>Phone</label>
                            <input type="text" name="Phone" class="form-control" value="<?php echo $Phone; ?>">
                            <span class="help-block"><?php echo $Phone_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Birth_Date_err)) ? 'has-error' : ''; ?>">
                            <label>Birth_Date</label>
                            <input type="text" name="Birth_Date" class="form-control" value="<?php echo $Birth_Date; ?>">
                            <span class="help-block"><?php echo $Birth_Date_err;?></span>
                        </div>
       
                        <input type="hidden" name="ID" value="<?php echo $ID; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="crud.php" class="btn btn-default">Cancel</a>
                    </form>
                
       
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