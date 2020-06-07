<?php
session_start();

require_once 'customFunctions/db_config.php';

$pass = $_POST['resetpassword'];
$reset_string = $_POST['reset_password'];

$sql = "SELECT * FROM users WHERE reset_string=:reset_string_p";
$sql_request = $connection->prepare($sql);
$sql_request->execute([':reset_string_p' => $reset_string]);

$sql_res = $sql_request->fetchObject();

// var_dump($sql_res);
if($sql_res){
	// var_dump($sql_res);
	$password_hashed = password_hash($pass, PASSWORD_DEFAULT);
		$sql_update = "UPDATE users SET password=:reset_password_p WHERE id=:res_id";
		$sql_update_request = $connection->prepare($sql_update);
		$sql_update_request->execute(['reset_password_p' => $password_hashed, 'res_id' => $sql_res->id]);

		header('Location: http://single-page-application.lan/index.php?password_changed=success#formLogin');
}
else{
	header('Location: http://single-page-application.lan/index.php');
	die('User not found');
}





?>