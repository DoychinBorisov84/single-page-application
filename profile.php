<?php
session_start();
require_once 'classes/Database.class.php';

// Database Instance
$db = new Database();

$user_email = $_SESSION['email'];
$user_firstName = $_SESSION['firstName'];
$user_lastName = $_SESSION['lastName'];	
$user_logged = $_SESSION['logged']; 
// $user_updated = $_SESSION['updated_at'];

$user_exist_db = $db->selectUserFromDatabase($user_email);

// Compare the session vs DB record
if($user_logged != $user_exist_db['logged'] || $user_logged == NULL || $user_exist_db == false ){
  session_unset();
  session_destroy();
	$login_error = 'restricted';
	header("Location: index.php?url_action=".$login_error.'#home-section');	
	die('Unable to proceed');
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>User Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" >
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/profile.css">    
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
          <button type="button" onclick="location.href='profile_edit.php'" id="edit_btn">Edit</button>
        </div>
        <div class="points center">
          <button type="button" onclick="location.href='profile_delete.php'" id="delete_btn">Delete</button>
        </div>
         <div id="imgHolder" style="display:flex; justify-content: center; align-items: center; padding-top: 50%;">
          <img src="<?php echo ($user_exist_db['image'] != '' && file_exists($user_exist_db['image']) ? $user_exist_db['image'] : 'images/profile.png') ?>" alt="FAIL" style="background-color: yellow;width:110px; height:110px; border-radius:40%;">
         </div>
      </div>
      <div class="more-info">
        <h1><?php echo($user_exist_db['firstName'] != '' ? 'Welcome, '. $user_exist_db['firstName'] : 'Enter First Name...'); ?></h1>
         <div class="coords">
          <p><strong>Last Profile Update: </strong>
          <span class="profile_span"><?php echo ($user_exist_db['updated_at'] != '' ? $user_exist_db['updated_at'] : 'Unknown Time...') ?></span></p>
          <p><strong>Email:</strong>
          <span class="profile_span"><?php echo($user_exist_db['email'] != '' ? $user_exist_db['email'] : 'Enter email...'); ?></p>
          <p><strong>First Name: </strong>
          <span class="profile_span"><?php echo($user_exist_db['firstName'] != '' ? $user_exist_db['firstName'] : 'Enter first name...'); ?></p>
          <p><strong>Last Name: </strong>
          <span class="profile_span"><?php echo($user_exist_db['lastName'] != '' ? $user_exist_db['lastName'] : 'Enter last name...'); ?></p>
        </div>
      </div>
     
       
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
  </script>

  </body>
</html>