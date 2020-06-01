<?php
session_start();
require_once 'customFunctions/db_config.php';

// $email = $_POST['resetpassword'];
$reset_password = $_POST['reset_password'];

// var_dump($_SESSION);

$sql = "SELECT * FROM users WHERE reset_string=:reset_password_p";
$sql_request = $connection->prepare($sql);
$sql_request->execute([':reset_password_p' => $reset_password]);

$sql_res = $sql_request->fetchObject();

// var_dump($sql_res);
if($sql_res){
	$password_hashed = password_hash($sql_res->password, PASSWORD_DEFAULT);
		$sql_update = "UPDATE users SET password=:reset_password_p WHERE id=:res_id";
		$sql_update_request = $connection->prepare($sql_update);
		$sql_update_request->execute([':reset_password_p' => $password_hashed, ':res_id' => $sql_res->id]);

		header('Location: http://single-page-application.lan/index.php?password_changed=success#formLogin');

}





?>