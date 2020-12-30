<?php 
session_start();

require_once 'classes/Database.class.php';

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
	header("Location: index.php?url_action=".$login_error);
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
		header("Location: http://user-administration.lan/index.php?url_action=".$login_error.'#home-section');
		die('Profile Deleted');
	}else{		
		$login_error = 'not_deleted';		
		header("Location: http://user-administration.lan/profile.php?url_action=unableToDelete");		
		die('Unable to delete user');
	}	
}