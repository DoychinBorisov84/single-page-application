<?php
//DB connection
include 'customFunctions/db_config.php';

//Form validation PDO
if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email_reg']) && isset($_POST['password_reg']) && isset($_POST['repassword']) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email_reg']) && !empty($_POST['password_reg']) && !empty($_POST['repassword'])){

	$firstName = validatePostData($_POST['firstName']);
	$lastName = validatePostData($_POST['lastName']);	
	$email_reg = validatePostData($_POST['email_reg']);
	$password_reg = validatePostData($_POST['password_reg']);
	$repassword = validatePostData($_POST['repassword']);
		$password_hashed = password_hash($password_reg, PASSWORD_DEFAULT);

	// Create the DB table if not exist
	$sql_exists = "SELECT * FROM information_schema.tables WHERE table_schema = :database_name AND table_name = :db_table_name LIMIT 1";
	$sql_exists_query = $connection->prepare($sql_exists);
	$sql_exists_query->execute(['database_name' => $database, 'db_table_name' => $database_table]);
	
	if($sql_exists_query->rowCount() == 0){
		$connection->exec($sql_create_table);			
	}
	// 					 
	
	// PDO
	// $exist_email_query = 'SELECT email FROM characters WHERE email=:email';
	$exist_email_query = 'SELECT email FROM users WHERE email=:email';
	$exist_email_query_req = $connection->prepare($exist_email_query);
	$exist_email_query_req->execute(['email' => $email_reg]);
	
	//Check if email/user exist
	if($exist_email_query_req->rowCount() == '1'){
		//email exist
		$message = 'user_exist';
		header("Location: index.php?error=".$message."#contact-section");
	}else{
	//Save the record to the DB
    // $pdo_query = 'INSERT INTO characters (firstName, lastName, email, password) VALUES(:firstName, :lastName, :email, :password)'; 
    $pdo_query = 'INSERT INTO users (firstName, lastName, email, password, created_at, updated_at) VALUES(:firstName, :lastName, :email, :password, now(), now())'; 
    $pdo_request = $connection->prepare($pdo_query);
    $pdo_request->execute(['firstName' => $firstName, 'lastName' => $lastName, 'email' => $email_reg, 'password' => $password_hashed]);
	header("Location: index.php");
      

    if($pdo_request->rowCount() != '1'){
    	echo 'Error saving the data'; 
    	exit();
    }
	}
}else{	
	$message='incorrect_data';
	header("Location: index.php?error=".$message);
	exit();	
}

//Validate post-data
function validatePostData($data) {
	  // $data = trim($data);
	  // $data = stripslashes($data);
	  // $data = htmlspecialchars($data);
  return $data;
}


?>