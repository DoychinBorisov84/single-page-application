<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require 'customFunctions/db_config.php';
require 'customFunctions/functions.php';
require 'classes/User.class.php';

//Form validation PDO
if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email_reg']) && isset($_POST['password_reg']) && isset($_POST['repassword']) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email_reg']) && !empty($_POST['password_reg']) && !empty($_POST['repassword'])){

	$firstName = validateData($_POST['firstName']);
	$lastName = validateData($_POST['lastName']);	
	$email_reg = validateData($_POST['email_reg']);
	$password_reg = validateData($_POST['password_reg']);
	$repassword = validateData($_POST['repassword']);
		// $password_hashed = password_hash($password_reg, PASSWORD_DEFAULT);

// echo $firstName; die;
	$user = new User($firstName, $lastName, $email_reg, $password_reg);

echo $user->userExist($email_reg); die;
    // $db_data = $user->getUserRecord($email_reg);

    // echo '<pre>'.print_r($db_data, true).'</pre>';
     // die();	
	//  TODO ::: implement the create table method()


	// Create the DB table if not exist
	$sql_exists = "SELECT * FROM information_schema.tables WHERE table_schema = :database_name AND table_name = :db_table_name LIMIT 1";
	$sql_exists_query = $connection->prepare($sql_exists);
	$sql_exists_query->execute([':database_name' => $database, ':db_table_name' => $database_table]);
	
	if($sql_exists_query->rowCount() == 0){
		$connection->exec($sql_create_table);			
	}else{ // we have the datatable created already		
		//Check if email/user exist		
		$user_exist = $user->userExist($email_reg);
		if($user_exist){
			$message = 'user_exist';
			header("Location: index.php?error=".$message."#contact-section");
			die('Email exists');
		}else{
		    $user_create = $user->userCreate($firstName, $lastName, $email, $password_hashed);

		    $message = 'profile_created';
			header("Location: index.php?error=".$message."#contact-section");
			die('User created');		     
		}
	}	
}else{	
	$message='incorrect_data';
	header("Location: index.php?error=".$message."#contact-section");
	exit();	
}
