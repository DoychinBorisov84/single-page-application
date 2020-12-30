<?php
session_start();
include 'customFunctions/db_config.php';
include 'classes/Database.class.php';

// New db-object
$db = new Database();

$user_email = $_SESSION['email'];
$user_firstName = $_SESSION['firstName'];
$user_lastName = $_SESSION['lastName'];
$user_logged = $_SESSION['logged'];	

$user_exist = $db->selectUserFromDatabase($user_email);

// Compare the session vs DB record
if($user_logged != $user_exist['logged']  || $user_logged == NULL || $user_exist == false){
	session_unset();
	session_destroy();
	$login_error = 'restricted';
	header("Location: index.php?url_action=".$login_error);	
	die('Unauthorized privileges to edit profile');
}else{
	$ajax_firstName = $_POST['firstName'];
	$ajax_lastName = $_POST['lastName'];
	$now_t = date('Y-m-d h:i:s');

	$res = $db->updateUserDatabase($ajax_firstName, $ajax_lastName, $now_t, $user_email);

	$_SESSION['firstName'] = $ajax_firstName;
	$_SESSION['lastName'] = $ajax_lastName;
}
