<?php

// Credentials for the Database
$username = 'root';
$password = 'r';
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
}catch(PDOException $e){
	echo $e->getMessage();
}

// $connection = null;