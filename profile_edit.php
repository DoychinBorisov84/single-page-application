<?php
session_start();

include_once 'customFunctions/config.php';
require_once 'classes/Database.class.php';

// New db-object
$db = new Database();

$user_email = $_SESSION['email'];
$user_firstName = $_SESSION['firstName'];
$user_lastName = $_SESSION['lastName'];
$user_logged = $_SESSION['logged'];	

$user_exist = $db->selectUserFromDatabase($user_email);

// Compare the session vs DB record
if($user_logged != $user_exist['logged'] || $user_logged == NULL || $user_exist == false){
	session_unset();
  session_destroy();
  $login_error = 'restricted';
  header("Location: http://user-administration/index.php?url_action=".$login_error.'#home-section');
	die('Unauthorized access');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>User Profile</title>
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
      <!-- image left-side -->      
      <div class="user-card">
        <div class="level center">
          <button type="button" onclick="location.href='profile.php'" id="back_btn">Back</button>
        </div>
        <div class="points center">
          <button type="button" id="save_btn">Save</button>
        </div>
         <div id="imgHolder" style="display:flex; justify-content: center; align-items: center; padding-top: 50%;">
          <img src="<?php echo ($user_exist['image'] != '' && file_exists($user_exist['image']) ? $user_exist['image'] : 'images/users/default.png') ?>" alt="FAIL" style="background-color: yellow;width:110px; height:110px; border-radius:40%;">
         </div>
      </div>
      <!-- right side -->
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
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" id="fileToUpload" name="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form>        
         <span id="message" style="color:white;font-weight:bold"></span>
      </div>
    </div>

    <div class="general">
      <h1><?php echo($user_exist['firstName'] != '' ? $user_exist['firstName']."'s Profile" : 'Enter name...') ?></h1>
      <p><strong>Email:</strong><span class="profile_span"> <?php echo($user_exist['email'] != '' ? $user_exist['email'] : 'Enter email...'); ?></span></p>
      <p><strong>First Name: </strong> <span class="profile_span"><?php echo($user_exist['firstName'] != '' ? $user_exist['firstName'] : 'Enter first name...'); ?></span></p>
      <p><strong>Last Name: </strong> <span class="profile_span"><?php echo($user_exist['lastName'] != '' ? $user_exist['lastName'] : 'Enter last name...'); ?></span></p>
      <span class="more">`Hover to edit...</span>
    </div>
  </div>
  
  <!-- scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>	
  <script>
   $(document).ready(function() {
    var get_msg = '<?php echo ($_GET['msg'] != '' ? $_GET['msg'] : ''); ?>';

    if(get_msg == 'img_exist'){
      $('#message').text('Sorry, file with same name already exists!');
    }else if(get_msg == 'img_size_err'){
      $('#message').text('Sorry, only valid files up to 2MB for image is allowed!');      
    }else if(get_msg == 'img_type_err'){
      $('#message').text('Sorry, only JPG, JPEG, PNG & GIF files are allowed!');            
    }else if(get_msg == 'img_success'){
      $('#message').text('Your profile picture was updated!');       
    }else if(get_msg == 'img_fail'){
      $('#message').text('Sorry, there was an error uploading the file on server!');    
    }else{
      $('#message').text('');
    }
   });

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
        $('#message').text('Profile Updated');
      },
      error: function(msg){
        $('#message').text('Error occured, unable to update.');        
      }
    });//ajax
  });//on click save_btn 

  </script>

  </body>
</html>