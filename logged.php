<?php
session_start();
include 'customFunctions/db_config.php'; // db_config_class.php !!!!
include 'customFunctions/functions.php';

// $Dbh = new Database();
// var_dump($Dbh);
// echo $Dbh->getX(); die();

if(isset($_POST['email_login']) && isset($_POST['password_login']) && !empty($_POST['email_login']) && !empty($_POST['password_login']) ){
	$email_login = validateData($_POST['email_login']);	
	$password_login = validateData($_POST['password_login']);
	
	$user_exist_query = "SELECT * FROM users WHERE email=:email_login";
	$user_exist_request = $connection->prepare($user_exist_query);
	$user_exist_request->execute([':email_login' => $email_login]);

	//Have only 1 email existing
	if($user_exist_request->rowCount() == '1'){			
		$row_user_pass = $user_exist_request->fetch(PDO::FETCH_ASSOC);
		$user_password_dehashed = password_verify($password_login, $row_user_pass['password']); // verify the pass
		
		if($user_password_dehashed){
			$_SESSION['email'] = $row_user_pass['email'];
			$_SESSION['firstName'] = $row_user_pass['firstName'];
			$_SESSION['lastName'] = $row_user_pass['lastName'];		
			$_SESSION['logged'] = microtime(true).'_'.$_SESSION['email'];// unique temp-logg-data
				$pdo_query_logged = "UPDATE users SET logged=:logged WHERE email=:email";
				$pdo_query_logged_request = $connection->prepare($pdo_query_logged);
				$pdo_query_logged_request->execute([':logged' => $_SESSION['logged'], ':email' => $email_login]);

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



