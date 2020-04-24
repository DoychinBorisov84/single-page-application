<?php
session_start();
include 'customFunctions/db_config.php';

$user_email = $_SESSION['email'];
$user_firstName = $_SESSION['firstName'];
$user_lastName = $_SESSION['lastName'];
$user_logged = $_SESSION['logged'];	
// var_dump($user_logged);

	$pdo_query = "SELECT logged FROM characters WHERE email=:user_email";
	$pdo_query_request = $connection->prepare($pdo_query);
	$pdo_query_request->execute(['user_email' => $user_email]);

	$col_logged_assoc = $pdo_query_request->fetch(PDO::FETCH_ASSOC);
	$cell_logged = $col_logged_assoc['logged'];

// Compare the session vs DB record
if($user_logged != $cell_logged || $user_logged == 'undefined' || $user_logged == NULL){
	$login_error = 'hacking';
	header("Location: index.php?error=".$login_error);
	session_unset();
	session_destroy();
	exit();
}

$ajax_data = $_POST['name'];

$sql_update = "UPDATE characters SET firstName=:ajax_data WHERE email=:user_email";
$sql_update_request = $connection->prepare($sql_update);
$sql_update_request->execute(['ajax_data' => $ajax_data, 'user_email' => $user_email]);

$_SESSION['firstName'] = $ajax_data;

// var_dump($_SESSION);

echo 'Successfully Updated';




?>