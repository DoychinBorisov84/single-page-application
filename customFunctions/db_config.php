<?php

// Credentials for the Database
$username = 'root';
$password = 'root!Admin1';
$database = 'single_page_application';
$host = 'localhost';
$dsn = "mysql:host=$host;dbname=$database";
$charset = 'utf8mb4';

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

// $connection = null;