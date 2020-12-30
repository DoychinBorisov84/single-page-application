<?php
session_start();

require_once 'classes/Database.class.php';

// New db-object
$db = new Database();

$email = $_POST['email'];

// Check the email in the DB if exists
$user_exist = $db->selectUserFromDatabase($email);

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

//Form validation
if($user_exist){
// var_dump($user_exist); die;
	$_SESSION['user_email'] = $sql_res['email'];
	// var_dump($_SESSION); die();
	$email_shuffle = str_shuffle($email);
	$email_shuffle = str_replace('@', '!$%', $email_shuffle);
	$curr_unix_time = time();

	$reset_string = $email_shuffle.$curr_unix_time;

	//  Update the user reset_string in the DB
	$user_reset = $db->setUserResetString($reset_string, $email);

	if($user_reset){
		// die('reset email');
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
		    $mail->setFrom($email, 'Name');	// $email will be the same as the $mail since it's for testing purposes via mailtrap.io 
		    $mail->addAddress('adminApplication@gmail.com');     // Add a recipient	    
		    $mail->addReplyTo($email, 'reply to');

		    // Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Reset your email';
		    $mail->Body    = '<html>
		    					<body>
		    						<p>Click the link to reset your password:</p>
		    						<a href="http://user-administration.lan/index.php?reset_password='.$reset_string.'#contact-section">Reset Password</a>
		    					</body>
		    					</html>
		    ';
		    $mail->AltBody = 'This the alternative body for the email';

		    $mail->send();

			$message = 'reset_password';
			header("Location: index.php?url_action=".$message."#message-section");
			exit();
		}catch (Exception $e) {
	 	 	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
	else{
		die('We are experiencing database issues, unable to reset the email currently!');
	}

	
}else{
	// Reset the password case?
	$reset_error = 'mailNotFound';
	header("Location: http://user-administration.lan/index.php?url_action=".$reset_error);
	exit();
}