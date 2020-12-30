<?php
session_start();

require_once 'classes/Database.class.php';

// New db-object
$db = new Database();

$pass = $_POST['resetpassword'];
$reset_string = $_POST['reset_password'];

// Select the user from the DB based on the reset_string passed as parameter in the form
$userForReset = $db->selectUserResetstring($reset_string);

if($userForReset){
	$password_hashed = password_hash($pass, PASSWORD_DEFAULT);

	// Update the user password
	$user_updated = $db->updateUserPassword($password_hashed, $userForReset['id']);

	if($user_updated){
		header('Location: index.php?url_action=password_changed#formLogin');
		exit();
	}
	else{
	 header('Location: index.php?url_action=unable_to_reset_pass#formLogin');
	 exit();
	}		
}
else{
	header('Location: http://single-page-application.lan/index.php');
	exit();
}