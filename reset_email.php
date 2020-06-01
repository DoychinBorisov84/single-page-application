<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include 'customFunctions/db_config.php';

//Get the session for the current registered/logged user
$email = $_POST['email'];


$sql = "SELECT email FROM users WHERE email=:email_p";
$sql_request = $connection->prepare($sql);
$sql_request->execute([':email_p' => $email]);
$sql_res = $sql_request->fetch();

// var_dump($sql_res); exit();

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
if($sql_res['email'] != ''){
	$_SESSION['user_email'] = $sql_res['email']	;
	// var_dump($_SESSION); die();
	$email_shuffle = str_shuffle($email);
	$email_shuffle = str_replace('@', '', $email_shuffle);
	$curr_unix_time = time();

	$reset_string = $email_shuffle.$curr_unix_time;

	$sql_q = "UPDATE users SET reset_string=:reset_string_p WHERE email=:email_p";
	$sql_q_request = $connection->prepare($sql_q);
	$sql_q_request->execute([':reset_string_p' => $reset_string, ':email_p' => $email]);


	// var_dump($reset_string); exit();
	// echo 'xssss';
	// $subject = validatePostData($_POST['subject']);	
	// $textarea = validatePostData($_POST['textarea']);	 

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
	    // $mail->Body    = 'Click the link to reset your password:'.'<a>'.'single-page-application.lan/index.php?reset_password='.$reset_string.'</a>';
	    $mail->Body    = '<html>
	    					<body>
	    						<p>Click the link to reset your password:</p>
	    						<a href="http://single-page-application.lan/index.php?reset_password='.$reset_string.'#contact-section">Reset Password</a>
	    					</body>
	    					</html>
	    ';
	    $mail->AltBody = 'This the alternative body for the email';

	    $mail->send();

		$message = 'reset_password';
		header("Location: index.php?error=".$message."#message-section");
		exit();
	}catch (Exception $e) {
 	 	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
}else{
	// Reset the password case?
	$reset_error = 'mailNotFound';
	// header("Location: index.php");
	header("Location: http://single-page-application.lan/index.php?error=".$reset_error);
	exit();
}

//Validate post-data
function validatePostData($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
  return $data;
}