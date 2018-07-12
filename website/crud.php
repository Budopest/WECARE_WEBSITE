
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patients Measurements</title>
	 <link rel="stylesheet" href="css/bootstrap.css">
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
   
	<link rel="stylesheet" type="text/css" href="style.css"/>
    
    <style type="text/css">
      
        .page-header h2{
            margin-top: 0;
        }
     
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
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
           
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Patients Details</h2>
						
						</div>
<?php
						session_start();
							if(!isset($_SESSION[`name`]))
									{
									header('Location: ./index.php');
	
									}

?>
<?php
					//session_start();
					$DOCTOR=$_SESSION[`name`];
              
                    $conn = new mysqli("localhost", "root", "", "healthcare");
					// Check connection
				if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
											}
                    // Attempt select query execution
                    $sql = "SELECT * FROM patients where Doctor='$DOCTOR'";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Name</th>";
										echo "<th>Tempreture</th>";
										echo "<th>HeartRate</th>";
										echo "<th>Pressure</th>";
										echo "<th>Diabetes</th>";
										echo "<th>Illness</th>";
                                        echo "<th>Medicines</th>";
										echo "<th>Dose</th>";
                                        echo "<th>Phone</th>";
										echo "<th>Birth_Date</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['ID'] . "</td>";
                                        echo "<td>" . $row['Name'] . "</td>";
										echo "<td>" . $row['Tempreture'] . "</td>";
										echo "<td>" . $row['Heart_Rate'] . "</td>";
										echo "<td>" . $row['Pressure'] . "</td>";
										echo "<td>" . $row['Diabetes'] . "</td>";
										echo "<td>" . $row['illness'] . "</td>";
										echo "<td>" . $row['Medicines'] . "</td>";
										echo "<td>" . $row['Dose'] . "</td>";
                                        echo "<td>" . $row['Phone'] . "</td>";
                                        echo "<td>" . $row['Birth_Date'] . "</td>";
                                        echo "<td class='iconss'>";
                                            echo "<a class='link' href='read.php?ID=". $row['ID'] ."' title='View Patient Details' data-toggle='tooltip'><span class='fas fa-eye'></span></a>";
                                            echo "<a class='link' href='update.php?ID=". $row['ID'] ."' title='Update Patient Data' data-toggle='tooltip'><span class='fas fa-pencil-alt'></span></a>";
											echo "<a class='link' href='history.php?ID=". $row['ID'] ."' title='patient history' data-toggle='tooltip'><span class='fas fa-history'></span></a>";
                                            echo "<a class='link' href='delete.php?ID=". $row['ID'] ."' title='Delete Record' data-toggle='tooltip'><span class='fas fa-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                    }
 
                    // Close connection
                    mysqli_close($conn);
 ?>
					
                   
       
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