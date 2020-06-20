<?php
session_start();
include 'customFunctions/db_config.php';
include 'classes/Database.class.php';

// New db-object
$db = new Database();

$user_email = $_SESSION['email'];
$user_firstName = $_SESSION['firstName'];
$user_lastName = $_SESSION['lastName'];
$user_logged = $_SESSION['logged'];	

$user_exist = $db->selectUserFromDatabase($user_email);

// Compare the session vs DB record
if($user_logged != $user_exist['logged']){
	session_unset();
  session_destroy();
  $login_error = 'hacking';
  header("Location: http://single-page-application.lan/index.php?error=".$login_error.'#home-section');
	die('Unauthorized access');
}

// var_dump($_SESSION);

// TODO: Handle the file upload
  // $target_dir = "uploads/";
  // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  // $uploadOk = 1;
  // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // // Check if image file is a actual image or fake image
  // if(isset($_POST["submit"])) {
  //   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  //   if($check !== false) {
  //     echo "File is an image - " . $check["mime"] . ".";
  //     $uploadOk = 1;
  //   } else {
  //     echo "File is not an image.";
  //     $uploadOk = 0;
  //   }
  // }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Cute Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" >   
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/profile_edit.css">    
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300" id="home">
  	<div class="center-buttons">
	  	<button type="button" class="btn btn-primary" id="homeButton">Home Page</button>
	  	<button type="button" class="btn btn-danger" id="exitButton">Exit Profile</button>
  	</div>
	<div class="center">

  <div class="card">
    <div class="additional">
      <div class="user-card">
        <div class="level center">
          <button type="button" onclick="location.href='profile.php'" id="back_btn">Back</button>
        </div>
        <div class="points center">
          <button type="button" id="save_btn">Save</button>
        </div>
        <svg width="110" height="110" viewBox="0 0 250 250" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="title desc" class="center">
          <title id="title">Your name</title>
          <desc id="desc">Cool profile of a user visiting www.yoursite.com</desc>
          <style>
            .skin { fill: #eab38f; }
            .eyes { fill: #1f1f1f; }
            .hair { fill: #2f1b0d; }
            .line { fill: none; stroke: #2f1b0d; stroke-width:2px; }
          </style>
          <defs>
            <clipPath id="scene">
              <circle cx="125" cy="125" r="115"/>
            </clipPath>
            <clipPath id="lips">
              <path d="M 106,132 C 113,127 125,128 125,132 125,128 137,127 144,132 141,142  134,146  125,146  116,146 109,142 106,132 Z" />
            </clipPath>
          </defs>
          <circle cx="125" cy="125" r="120" fill="rgba(0,0,0,0.15)" />
          <g stroke="none" stroke-width="0" clip-path="url(#scene)">
            <rect x="0" y="0" width="250" height="250" fill="#b0d2e5" />
            <g id="head">
              <path fill="none" stroke="#111111" stroke-width="2" d="M 68,103 83,103.5" />
              <path class="hair" d="M 67,90 67,169 78,164 89,169 100,164 112,169 125,164 138,169 150,164 161,169 172,164 183,169 183,90 Z" />
              <circle cx="125" cy="100" r="55" class="skin" />
              <ellipse cx="102" cy="107" rx="5" ry="5" class="eyes" id="eye-left" />
              <ellipse cx="148" cy="107" rx="5" ry="5" class="eyes" id="eye-right" />
              <rect x="119" y="140" width="12" height="40" class="skin" />
              <path class="line eyebrow" d="M 90,98 C 93,90 103,89 110,94" id="eyebrow-left" />
              <path class="line eyebrow" d="M 160,98 C 157,90 147,89 140,94" id="eyebrow-right"/>
              <path stroke="#111111" stroke-width="4" d="M 68,103 83,102.5" />
              <path stroke="#111111" stroke-width="4" d="M 182,103 167,102.5" />
              <path stroke="#050505" stroke-width="3" fill="none" d="M 119,102 C 123,99 127,99 131,102" />
              <path fill="#050505" d="M 92,97 C 85,97 79,98 80,101 81,104 84,104 85,102" />
              <path fill="#050505" d="M 158,97 C 165,97 171,98 170,101 169,104 166,104 165,102" />
              <path stroke="#050505" stroke-width="3" fill="rgba(240,240,255,0.4)" d="M 119,102 C 118,111 115,119 98,117 85,115 84,108 84,104 84,97 94,96 105,97 112,98 117,98 119,102 Z" />
              <path stroke="#050505" stroke-width="3" fill="rgba(240,240,255,0.4)" d="M 131,102 C 132,111 135,119 152,117 165,115 166,108 166,104 166,97 156,96 145,97 138,98 133,98 131,102 Z" />
              <path class="hair" d="M 60,109 C 59,39 118,40 129,40 139,40 187,43 189,99 135,98 115,67 115,67 115,67 108,90 80,109 86,101 91,92 92,87 85,99 65,108 60,109" />
              <path id="mouth" fill="#d73e3e" d="M 106,132 C 113,127 125,128 125,132 125,128 137,127 144,132 141,142  134,146  125,146  116,146 109,142 106,132 Z" /> 
              <path id="smile" fill="white" d="M125,141 C 140,141 143,132 143,132 143,132 125,133 125,133 125,133 106.5,132 106.5,132 106.5,132 110,141 125,141 Z" clip-path="url(#lips)" />
            </g>
            <g id="shirt">
              <path fill="#8665c2" d="M 132,170 C 146,170 154,200 154,200 154,200 158,250 158,250 158,250 92,250 92,250 92,250 96,200 96,200 96,200 104,170 118,170 118,170 125,172 125,172 125,172 132,170 132,170 Z"/>
              <path id="arm-left" class="arm" stroke="#8665c2" fill="none" stroke-width="14" d="M 118,178 C 94,179 66,220 65,254" />
              <path id="arm-right" class="arm" stroke="#8665c2" fill="none" stroke-width="14" d="M 132,178 C 156,179 184,220 185,254" />
              <path fill="white" d="M 117,166 C 117,166 125,172 125,172 125,182 115,182 109,170 Z" />
              <path fill="white" d="M 133,166 C 133,166 125,172 125,172 125,182 135,182 141,170 Z" />
              <circle cx="125" cy="188" r="4" fill="#5a487b" />
              <circle cx="125" cy="202" r="4" fill="#5a487b" />
              <circle cx="125" cy="216" r="4" fill="#5a487b" />
              <circle cx="125" cy="230" r="4" fill="#5a487b" />
              <circle cx="125" cy="244" r="4" fill="#5a487b" />
              <path stroke="#daa37f" stroke-width="1" class="skin hand" id="hand-left" d="M 51,270 C 46,263 60,243 63,246 65,247 66,248 61,255 72,243 76,238 79,240 82,243 72,254 69,257 72,254 82,241 86,244 89,247 75,261 73,263 77,258 84,251 86,253 89,256 70,287 59,278" /> 
              <path stroke="#daa37f" stroke-width="1" class="skin hand" id="hand-right" d="M 199,270 C 204,263 190,243 187,246 185,247 184,248 189,255 178,243 174,238 171,240 168,243 178,254 181,257 178,254 168,241 164,244 161,247 175,261 177,263 173,258 166,251 164,253 161,256 180,287 191,278"/> 
            </g>
          </g>
        </svg>
      </div>
      <div class="more-info">
        <h1 class="editable" id="email_edit"><?php echo($user_exist['email'] != '' ? $user_exist['email'] : 'Enter email...'); ?></h1>        
        <div class="coords">
          <span>First Name</span>
          <span contenteditable="true" class="editable" id="firstname_edit"><?php echo($user_exist['firstName'] != '' ? $user_exist['firstName'] : 'Enter First Name...'); ?></span>
        </div>
        <div class="coords">
          <span>Last Name</span>
          <span contenteditable="true" class="editable" id="lastname_edit"><?php echo($user_exist['lastName'] != '' ? $user_exist['lastName'] : 'Enter Last Name...' ) ?></span>
        </div>
        <form action="#" method="POST" enctype="multipart/form-data">
          <div class="coords">
            <span>Upload Picture</span>
            <input type="file" id="fileToUpload" name="fileToUploade">
            <input type="submit">
          </div>  
        </form>        
         <span id="message" style="color:red;"></span>
         <!-- <div class="coords">
          <span>Professional Occupation</span>
          <span contenteditable="true" class="editable" id="profession_edit">xxxxxx</span>
        </div> -->
        <!-- <div class="stats"> -->
          <!-- <div> -->
            <!-- <div class="title">Years of exp</div> -->
            <!-- <i class="fa fa-trophy"></i>
            <div class="value">4+</div> -->
           <!--  <select class="browser-default custom-select">
              <option selected>Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select> -->
          <!-- </div> -->
          <!-- <div>
            <div class="title">Projects</div>
            <i class="fa fa-gamepad"></i>
            <div class="value">10+</div>
          </div> -->
          <!-- <div> -->
            <!-- <div class="title">Relocate</div> -->
            <!-- <i class="fa fa-group"></i>
            <div class="value">Yes</div> -->
            <!-- Default inline 1-->
            <!-- <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" id="defaultInline1" name="inlineDefaultRadiosExample">
              <label class="custom-control-label" for="defaultInline1">Yes</label>
            </div> -->

            <!-- Default inline 2-->
            <!-- <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" id="defaultInline2" name="inlineDefaultRadiosExample">
              <label class="custom-control-label" for="defaultInline2">No</label>
            </div> -->

            <!-- Default inline 3-->
          <!-- </div> -->
         <!--  <div>
            <div class="title">Coffee</div>
            <i class="fa fa-coffee"></i>
            <div class="value infinity">∞</div>
          </div> -->
        <!-- </div> -->
      </div>
    </div>
    <div class="general">
      <h1><?php echo($user_exist['firstName'] != '' ? $user_exist['firstName']."'s Profile" : 'Enter name...') ?></h1>
      <p><strong>Email:</strong> <?php echo($user_exist['email'] != '' ? $user_exist['email'] : 'Enter email...'); ?></p>
      <p><strong>First Name: </strong> <?php echo($user_exist['firstName'] != '' ? $user_exist['firstName'] : 'Enter first name...'); ?></p>
      <p><strong>Last Name: </strong> <?php echo($user_exist['lastName'] != '' ? $user_exist['lastName'] : 'Enter last name...'); ?></p>
      <span class="more">`Hover to edit...</span>
    </div>
  </div>
  
  <!-- scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>	
  <script>
  //Home
	$('#homeButton').on('click', function(){
		window.location.href= "index.php";
	});	

	//Exit
	$('#exitButton').on('click', function(){
		window.location.href= "logout.php";
	});	

  //save data to mqslq-db
  $(document).on('click', '#save_btn', function(e){  
    // var email_input = $('#email_edit').text();
    var firstName_input = $('#firstname_edit').text();
    var lastName_input = $('#lastname_edit').text();
    $.ajax({
      data: {
             firstName: firstName_input,
             lastName: lastName_input
      },
      method: "POST",
      url: "profile_edit_save_db.php",
      success: function(msg){
        console.log("Yes, " + msg);
        $('#message').text('Profile Updated');
      },
      error: function(msg){
        $('#message').text('Error occured, unable to update.');        
      }
    })//ajax
  });//document on click

  </script>

  </body>
</html>