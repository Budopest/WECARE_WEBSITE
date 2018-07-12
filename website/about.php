<?php
session_start();
if(isset($_SESSION[`name`]))
{
	header('Location: ./afterlogin/about.php');
	
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
             <form action="signed.php" method="post">
			
			<div class="form-group">
                <label>First Name</label>
                <input type="text" name="fname"class="form-control">
            </div>  
			<div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lname"class="form-control">
            </div>    
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username"class="form-control">
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            
			<div class="form-group">
                <label>Phone</label>
                <input type="text" name="Phone" class="form-control">
            </div>
			<div class="form-group">
                <label>Birthday</label>
                <input type="date" name="birthday" class="form-control"">
            </div>
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
      <li class="nav-item ">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
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


<!-- Start carousel -->
<!-- <div id="myslide" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#myslide" data-slide-to="0" class="active"></li>
    <li data-target="#myslide" data-slide-to="1"></li>
    <li data-target="#myslide" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="img/7.jpg" alt="First slide">
	  <div class="carousel-caption d-none d-md-block">
    <h1>We Care For You</h1>
    <p>High quality care makes a difference</p>
  </div>
    </div>
	
    <div class="carousel-item">
	<div class="fields">
      <img class="d-block w-100" src="img/2.jpg" alt="Second slide">
    </div>
	</div>
    <div class="carousel-item">
	<div class="fields">
      <img class="d-block w-100" src="img/904.jpg" alt="Third slide">
    </div>
	</div>
  </div>
  <a class="carousel-control-prev" href="#myslide" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#myslide" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
 -->




<!-- END carousel -->
<!-- START about section -->

<section class="about-page">
<div class="container">
<h2>Medical Health Care System</h2>
<p class="lead">A hardware kit which is responsible for taking regular measurement for the patient display it and send it through the internet where its stored in a database.
The database contains information about the patient condition, his medical history records, the current doctor assigned to the case, the medical prescription, the medicines doses and more. 
All this data is available for the doctors on the website where it can be viewed or modified.
A mobile app is used by the patients to help them keeps track with their case, notify them about their medication times and make easy communications with the doctors through calls or messages.
The app also keeps track of the measurements taken by the hardware kit and takes actions if needed in emergency cases by calling or sending messages to family members, doctors or an ambulance based on how serious the case is.
</p>

</div>
</section>

<!-- END abdout section -->

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