<?php

// Credentials for the Database
$username = 'root';
$password = 'root!Admin1';
$database = 'single_page_application';
$host = 'localhost';
$dsn = "mysql:host=$host;dbname=$database";
$charset = 'utf8mb4';
$database_table = 'users';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try{
	$connection = new PDO($dsn, $username, $password, $options);	
	 // die(json_encode(array('outcome' => true)));
}catch(PDOException $e){
	echo $e->getMessage();
	// die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
}

// Create DB table for users
$admin_pass = password_hash('admin1', PASSWORD_DEFAULT);

// function db_create(){
	$sql_create_table = "CREATE TABLE users (
	  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	  firstName VARCHAR(40) NOT NULL,
	  lastName VARCHAR(40) NOT NULL,
	  email VARCHAR(40) NOT NULL,
	  logged VARCHAR(50),
	  password VARCHAR(99) NOT NULL,
	  created_at VARCHAR(30),
	  updated_at VARCHAR(30)
  );
  INSERT INTO users (firstname, lastName, email, password, created_at, updated_at) VALUES('Administrator', 'Administrator', 'admin@gmail.com', '".$admin_pass."', now(), now())";


// $connection = null;