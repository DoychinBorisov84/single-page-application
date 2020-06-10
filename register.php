<?php
session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require 'customFunctions/db_config.php';
require 'customFunctions/functions.php';
require 'classes/User.class.php';

//Form validation PDO
if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email_reg']) && isset($_POST['password_reg']) && isset($_POST['repassword']) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email_reg']) && !empty($_POST['password_reg']) && !empty($_POST['repassword'])){

	$firstName = validateData($_POST['firstName']);
	$lastName = validateData($_POST['lastName']);	
	$email_reg = validateData($_POST['email_reg']);
	$password_reg = validateData($_POST['password_reg']);
	$repassword = validateData($_POST['repassword']);

	// Instance of the class User
	$user = new User($firstName, $lastName, $email_reg, $password_reg);
	
	// Check if the datatable exists
	$db_exists =  $user->databaseExist();
	/// Create the DB table if not exist, and add the new user into the database
	if(!$db_exists){	
		$createDb = $user->createDatabase();
		$user_create = $user->userCreate($firstName, $lastName, $email, $password_hashed);			
			$_SESSION['firstName'] = $firstName;
			$_SESSION['lastName'] = $lastName;		
			$_SESSION['email'] = $email_reg;
			$_SESSION['updated_at'] = date('Y-m-d h:i:s');
		$message = 'user_registered';		
		header("Location: index.php?error=".$message."#home-section");				
	}else{
		// We have the datatable created, Check if email/user exist	
		$user_exist = $user->userExist($email_reg);
		if($user_exist){
			$message = 'user_exist';
			header("Location: index.php?error=".$message."#contact-section");
			die('Email exists');
		}else{
			// Save the new user
		    $user_create = $user->userCreate($firstName, $lastName, $email, $password_hashed);

		    $message = 'profile_created';
			header("Location: index.php?error=".$message."#contact-section");
			die('User created');		     
		}
	}	
}else{	
	$message='incorrect_data';
	header("Location: index.php?error=".$message."#contact-section");
	exit();	
}
