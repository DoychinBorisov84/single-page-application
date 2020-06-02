<?php
include 'customFunctions/db_config.php';
session_start();

if(isset($_POST['email_login']) && isset($_POST['password_login']) && !empty($_POST['email_login']) && !empty($_POST['password_login']) ){
	$email_login = validatePostData($_POST['email_login']);
	// $password = validatePostData($_POST['password_login']);
	$password_login = $_POST['password_login'];

	// find the email in the db and compare the dehashed pass to the one entered... HEREEE

	// $user_email_query = "SELECT email FROM characters WHERE email=:email_login";
	$user_email_query = "SELECT email FROM users WHERE email=:email_login";

	$user_email_request = $connection->prepare($user_email_query);
	$user_email_request->execute(['email_login' => $email_login]);
// var_dump($user_email_request->rowCount()); die();
	//Have only 1 email existing
	if($user_email_request->rowCount() == '1'){
		//get the pass for that email
		// $user_password_query = "SELECT password FROM characters WHERE email=:email_login";
		$user_password_query = "SELECT password FROM users WHERE email=:email_login";

		$user_password_request = $connection->prepare($user_password_query);
		$user_password_request->execute(['email_login' => $email_login]);

		if($user_password_request->rowCount() == '1'){			
			$row_user_pass = $user_password_request->fetch(PDO::FETCH_ASSOC);
// var_dump($row_user_pass); die();
			$user_password_dehashed = password_verify($password_login, $row_user_pass['password']); // verify the pass
			// var_dump($row_user_pass['password']); die();
			if($user_password_dehashed){
				//Get all the data from the DB for the user
				// $user_data_query = "SELECT * FROM characters WHERE email=:email_login";
				$user_data_query = "SELECT * FROM users WHERE email=:email_login";				
				$user_data_request = $connection->prepare($user_data_query);
				$user_data_request->execute(['email_login' => $email_login]);
				$user_data = $user_data_request->fetch(PDO::FETCH_ASSOC);


				$_SESSION['email'] = $user_data['email'];
				$_SESSION['firstName'] = $user_data['firstName'];
				$_SESSION['lastName'] = $user_data['lastName'];		
					$_SESSION['logged'] = microtime(true).'_'.$_SESSION['email'];// unique temp-logg-data
					// $pdo_query_logged = "UPDATE characters SET logged=:logged WHERE email=:email";
					$pdo_query_logged = "UPDATE users SET logged=:logged WHERE email=:email";
					$pdo_query_logged_request = $connection->prepare($pdo_query_logged);
					$pdo_query_logged_request->execute(['email' => $_SESSION['email'], 'logged' => $_SESSION['logged']]);						

				header("Location: profile.php");				
			}else{
				//wrong credentials;
				$login_error='error_credentials';
				header("Location: index.php?error=".$login_error);
				exit();
			}

		}else{
			//password failed
			$login_error='error_credentials';
			header("Location: index.php?error=".$login_error);
			exit();	
		}

	}else{
		//email not found
		$login_error='error_credentials';
		header("Location: index.php?error=".$login_error);
		exit();
	}
		
}else{
	// Direct page access attempt
	$login_error='error_incorrect_data';	
	header("Location: index.php?error=".$login_error);
	exit();
}

//Validate post-data
function validatePostData($data) {
	  // $data = trim($data);
	  // $data = stripslashes($data);
	  // $data = htmlspecialchars($data);
  return $data;
}

