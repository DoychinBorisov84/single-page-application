<?php 
session_start();
include 'customFunctions/db_config.php';
include 'classes/Database.class.php';

// Database Instance
$db = new Database();

$user_email = $_SESSION['email'];
$user_firstName = $_SESSION['firstName'];
$user_lastName = $_SESSION['lastName'];
$user_logged = $_SESSION['logged'];	


$user_exist = $db->selectUserFromDatabase($user_email);

// Compare the session vs DB record
if($user_logged != $user_exist['logged']){
	$login_error = 'hacking';
	header("Location: index.php?error=".$login_error);
	session_unset();
	session_destroy();
	die('Unauthorized access');
}else{	
	// Delete the database record
	$user_delete = $db->deleteUserDatabase($user_email);

	if($user_delete){		
		session_unset();
		session_destroy();
		$login_error = 'profile_deleted';
		header("Location: http://single-page-application.lan/index.php?error=".$login_error.'#home-section');
		die('Profile Deleted');
	}else{		
		$login_error = 'not_deleted';		
		header("Location: http://single-page-application.lan/profile.php?error=unableToDelete");		
		die('Unable to delete user');
	}	
}



?>