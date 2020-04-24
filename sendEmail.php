<?php
session_start();

//Get the session for the current registered/logged user
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$email = $_SESSION['email'];

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

//DB connection
include 'customFunctions/db_config.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

//Form validation
if(isset($_POST['subject']) && isset($_POST['textarea']) && !empty($_POST['subject']) && !empty($_POST['textarea'])){	
	$subject = validatePostData($_POST['subject']);	
	$textarea = validatePostData($_POST['textarea']);	 

	//Send an email
	try {
	    //Server settings
	    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
	    $mail->isSMTP();                                            // Set mailer to use SMTP
	    $mail->Host       = 'smtp.mailtrap.io';  // Specify main and backup SMTP servers    
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = '98852474c7a462';                     // SMTP username
	    $mail->Password   = 'd27906b6db11c3';                               // SMTP password
	    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
	    $mail->Port       = 587;                                    // TCP port to connect 587 or to abv.bg -> 465

	    //Recipients
	    $mail->setFrom($email, $firstName);	// $email will be the same as the $mail since it's for testing purposes via myAccount-google 
	    $mail->addAddress('doichinborisov84@gmail.com');     // Add a recipient	    
	    $mail->addReplyTo($email, $firstName);

	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = $subject;
	    $mail->Body    = $textarea;
	    $mail->AltBody = 'This the alternative body for the email';

	    $mail->send();

		$message = 'message_sent';
		header("Location: index.php?error=".$message."#message-section");
		exit();
	}catch (Exception $e) {
 	 	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
}else{	
	header("Location: index.php");
	exit();
}

//Validate post-data
function validatePostData($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
  return $data;
}