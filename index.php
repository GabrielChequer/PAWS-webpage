<?php
    setcookie("ridArray","not blank value", time()+3600,'/index.php'); //ridArray=>not blank value
    setcookie("ccc","dsa", time()+3600); //ridArray=>not blank value
    //I changed the location of the files so everything is in the src folder, looks cleaner, this needs to be consistent so we can all work on the same version with the same files
  require_once 'php/login_function.php';
  require_once 'php/signup_function.php';
  if(isset($_POST['login_button'])){
    user_login();       //If the button for the login form is pressed go to the function user_login() in login_function.php
  } elseif (isset($_POST['signup_button'])) {
    user_signup();      //If the button for the signup form is pressed go to the function user_signup() in signup_function.php
  }
    
    if(isset($_COOKIE['name'])){
      //print_r($_COOKIE);
      session_start();
    }
?>
<!DOCTYPE html>
<html>
<title>Paws</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/main.css">
<style>
html,body,h1,h2,h3,h4 {font-family:"Lato", sans-serif}
.mySlides {display:none}
.w3-tag, .fa {cursor:pointer}
.w3-tag {height:15px;width:15px;padding:0;margin-top:6px}
#imgg {
  border-radius: 50%;
}
.w3-bar .w3-button {
  padding: 16px;
}
</style>
<body>

<!-- Links (sit on top) -->
<!-- Navbar (sit on top) -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-card" id="myNavbar">
      <a href="#" class="w3-bar-item w3-button w3-wide">PAWS</a>
      <!-- Right-sided navbar links -->
      <div class="w3-right w3-hide-small">
        <a href="#services" class="w3-bar-item w3-button">SERVICES</a>
        <a href="#about" class="w3-bar-item w3-button">ABOUT</a>
        <a href="#contact" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> CONTACT</a>
        <?php
          if(isset($_SESSION)){
            echo '<a href="http://pawsveterinary.000webhostapp.com/dashboard_owner.php" class="w3-bar-item w3-button" id="top_right2">'.$_SESSION['name'].'</a>';
            //echo '<a href="http://pawsveterinary.000webhostapp.com/php/logout.php" class="w3-bar-item w3-button" id="top_right2">'.$_SESSION['name'].'</a>';
          }else{
              echo '<a onclick="document.getElementById'."('id01')".".style.display='block'".'" class="w3-bar-item w3-button" id="top_right1">SIGN-IN</a>';
          }
        ?>
      </div>
      <!-- Hide right-floated links on small screens and replace them with a menu icon -->
  
      <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
        <i class="fa fa-bars"></i>
      </a>
    </div>
  </div>
  
  <!-- Sidebar on small screens when clicking the menu icon -->
  <nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16"><i class="fa fa-close"></i> Close</a>
    <a href="#services" onclick="w3_close()" class="w3-bar-item w3-button">SERVICES</a>
    <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button">ABOUT</a>
    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button">CONTACT</a>
    <a onclick="document.getElementById('id01').style.display='block'" class="w3-bar-item w3-button">SIGN-IN</a>
  </nav>

<!-- Content -->
<div class="w3-content" style="max-width:1100px;margin-top:80px;margin-bottom:80px">

  <!-- Slideshow -->
  <div class="w3-container">
    <div class="w3-display-container mySlides">
      <img src="img/hotel.jpg" style="width:100%">
      <div class="w3-display-topleft w3-container w3-padding-32">
        <span class="w3-white w3-padding-large w3-animate-bottom">Pet Hotel</span>
      </div>
    </div>
    <div class="w3-display-container mySlides">
      <img src="img/care.jpg" style="width:100%">
      <div class="w3-display-middle w3-container w3-padding-32">
        <span class="w3-white w3-padding-large w3-animate-bottom">Vet Care</span>
      </div>
    </div>
    <div class="w3-display-container mySlides">
      <img src="img/grooming.jpg" style="width:100%">
      <div class="w3-display-topright w3-container w3-padding-32">
        <span class="w3-white w3-padding-large w3-animate-bottom">Grooming</span>
      </div>
    </div>

    <!-- Slideshow next/previous buttons -->
    <div class="w3-container w3-dark-grey w3-padding w3-xlarge">
      <div class="w3-left" onclick="plusDivs(-1)"><i class="fa fa-arrow-circle-left w3-hover-text-teal"></i></div>
      <div class="w3-right" onclick="plusDivs(1)"><i class="fa fa-arrow-circle-right w3-hover-text-teal"></i></div>
    
      <div class="w3-center">
        <span class="w3-tag demodots w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
        <span class="w3-tag demodots w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
        <span class="w3-tag demodots w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
      </div>
    </div>
  </div>
  
  <!-- Grid Offers-->
  <div class="w3-row w3-row-padding w3-container" id="services">
    <div class="w3-center w3-padding-64">
      <span class="w3-xlarge w3-bottombar w3-border-dark-grey w3-padding-16">Services We Offer</span>
    </div>
    <div class="w3-third w3-dark-grey w3-margin-bottom">
        <h3>Pet Hotel</h3>
        <div class="w3-card-4">
          <img src="img/vet.jpg" style="width:100%;">
          <div class="w3-container">
            <p></p>
            <p><button class="w3-button w3-light-grey w3-block">Make Appointment</button></p>
          </div>
        </div>
      </div>
  
      <div class="w3-third w3-dark-grey w3-margin-bottom">
        <h3>Veterinary Care</h3>
        <div class="w3-card-4">
          <img src="img/vet.jpg" style="width:100%">
          <div class="w3-container">
            <p></p>
            <p><button class="w3-button w3-light-grey w3-block">Make Appointment</button></p>
          </div>
        </div>
      </div>
  
      <div class="w3-third w3-dark-grey w3-margin-bottom">
        <h3>Grooming</h3>
        <div class="w3-card-4">
          <img src="img/vet.jpg" style="width:100%">
          <div class="w3-container">
            <p></p>
            <p><button class="w3-button w3-light-grey w3-block">Make Appointment</button></p>
          </div>
        </div>
      </div>
  </div>

  <!-- Grid People-->
  <div class="w3-row-padding" id="about">
    <div class="w3-center w3-padding-64">
      <span class="w3-xlarge w3-bottombar w3-border-dark-grey w3-padding-16">Doctor Network</span>
    </div>
    
    <?php
        require_once 'php/db_connection.php';
        $conn = OpenCon();
        $sql_vets = "SELECT first_name_vet, last_name_vet, email_vet FROM VETS";
        $result_vets = mysqli_query($conn,$sql_vets);
        while($row = mysqli_fetch_array($result_vets)) {
            echo '<div class="w3-third w3-margin-bottom">
              <div class="w3-card-4">
                <img src="img/spec1.png" alt="John" style="width:100%" id="imgg">
                <div class="w3-container">
                  <h3>'.$row['first_name_vet'].' '.$row['last_name_vet'].'</h3>
                  <p class="w3-opacity">Doctor</p>
                  <p>Contact information: '.$row['email_vet'].'</p>
                  <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
                </div>
              </div>
            </div>';
        }
        CloseCon($conn);
    ?>
  </div>

  <!-- Contact -->
  <div class="w3-center w3-padding-64" id="contact">
    <span class="w3-xlarge w3-bottombar w3-border-dark-grey w3-padding-16">Contact Us</span>
  </div>

  <form class="w3-container" action="/action.php" target="_blank">
    <div class="w3-section">
      <label>Name</label>
      <input class="w3-input w3-border w3-hover-border-black" style="width:100%;" type="text" name="Name" required>
    </div>
    <div class="w3-section">
      <label>Email</label>
      <input class="w3-input w3-border w3-hover-border-black" style="width:100%;" type="text" name="Email" required>
    </div>
    <div class="w3-section">
      <label>Subject</label>
      <input class="w3-input w3-border w3-hover-border-black" style="width:100%;" type="text" name="Subject" required>
    </div>
    <div class="w3-section">
      <label>Message</label>
      <input class="w3-input w3-border w3-hover-border-black" style="width:100%;" type="text" name="Message" required>
    </div>
    <div class="w3-section">
        <label>Doctor (Optional)</label>
        <input class="w3-input w3-border w3-hover-border-black" style="width:100%;" type="text" name="Doctor">
      </div>
    <button type="submit" class="w3-button w3-block w3-black">Send</button>
  </form>

</div>


<!-- Sign In form -->
<div id="id01" class="modal">
  
  <form class="modal-content animate" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img/login.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
       
      <label for="text" class="vet"><b>I am a Veterinarian</b></label>
      <input type="checkbox" id="vetLog0" class="vet vetcheck" name="vetLogin" onclick="vetLoginSelect();">

      <div class="vetLogID" id="vetLog1">
        <label for="vetLogId"><b>Vet ID</b></label>
        <input type="text" placeholder="Enter Veterinarian ID" name="vetLogId">
      </div>
      <hr>

      <button type="submit" name="login_button">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container containerView" style="background-color:#f1f1f1">
      <span class="reg">Don't have an account? <a href="javascript:;" onclick="showReg();">Register</a></span>
      <span class="psw">Forgot <a href="#">Password?</a></span>
    </div>
  </form>
</div>

<!--Registration form-->
<div id="id02" class="modal">
  <form class="modal-content" method="post">
    <div class="container">
      <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      </div>

      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>

      <label for="text" class="vet"><b>I am a Veterinarian</b></label>
      <input type="checkbox" id="vet00" class="vet vetcheck" name="vet" onclick="vetSignUpSelect();">
      <hr>
      <label for="text"><b>First Name</b></label>
      <input type="text" placeholder="Enter First Name" name="first_name" required>

      <label for="text"><b>Last Name</b></label>
      <input type="text" placeholder="Enter Last Name" name="last_name" required>

      <label for="text"><b>Address</b></label>
      <input type="text" placeholder="Enter Address" name="address" required>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="uname" required>

      <div class="vetID" id="vet01">
        <label for="vetid"><b>Vet ID</b></label>
        <input type="text" placeholder="Enter Veterinarian ID" name="vetid">
      </div>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <label for="psw-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

      <div class="clearfix">
        <button type="submit" class="signupbtn" name="signup_button">Sign Up</button>
      </div>
    </div>
  </form>
</div>


<!-- Footer -->

<footer class="w3-container w3-padding-32 w3-light-grey w3-center">

  <a href="#" class="w3-button w3-black w3-margin"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
  <div class="w3-xlarge w3-section">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
  </div>

</footer>

<script type="text/javascript" src="js/behavior.js"></script>

</body>
</html>

