<?php
session_start();
include 'customFunctions/db_config.php'; // db_config_class.php !!!!
include 'customFunctions/functions.php';
include 'classes/Database.class.php';

// New db-object
$db = new Database();

if(isset($_POST['email_login']) && isset($_POST['password_login']) && !empty($_POST['email_login']) && !empty($_POST['password_login']) ){
	$email_login = validateData($_POST['email_login']);	
	$password_login = validateData($_POST['password_login']);
	
	// Check if we have record with that email
	$rec_exist = $db->selectUserFromDatabase($email_login);
	
	if($rec_exist){					
		$user_password_dehashed = password_verify($password_login, $rec_exist['password']); // verify the pass
		
		if($user_password_dehashed){
			// var_dump('here');exit;
			$_SESSION['id'] = $rec_exist['id'];
			$_SESSION['email'] = $rec_exist['email'];
			$_SESSION['firstName'] = $rec_exist['firstName'];
			$_SESSION['lastName'] = $rec_exist['lastName'];		
			$_SESSION['logged'] = microtime(true).'_'.$_SESSION['email'];// unique temp-logg-data

			$db->setUserLogged($email_login, $_SESSION['logged']);

			header("Location: profile.php");				
		}else{
			// wrong credentials;
			$login_error='error_credentials';
			header("Location: index.php?error=".$login_error);
			exit();
		}		
	}else{
		//email not found
		$login_error='error_exists';
		header("Location: index.php?error=".$login_error);
		exit();
	}		
}else{
	// Direct page access attempt
	$login_error='error_incorrect_data';	
	header("Location: index.php?error=".$login_error);
	exit();
}



