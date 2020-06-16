<?php

// Credentials for the Database
class Database{

	private $username = 'root';
	private $password = 'root';
	private $database = 'single_page_application';
	private $host = 'localhost';
	private $dsn = "mysql:host=localhost;dbname=single_page_application";
	private $charset = 'utf8mb4';
	private $database_table = 'users';
	private $connection;

	private $options = [
	    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	    PDO::ATTR_EMULATE_PREPARES   => false,
	];

	public function __construct(){
		try{
		// $this->connection = new PDO($this->dsn, $this->username, $this->password, $this->options);	
		$this->connection = new PDO($this->dsn, $this->username, $this->password);	
			 // die(json_encode(array('outcome' => true)));
		}catch(PDOException $e){
			echo $e->getMessage();
			// die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
		}		
	}

	/**
	 * Select user from the database, using an email as parameter. Returns user as AssocArray	
	 * @param string $email 
    */
	public function selectUserFromDatabase($email){
		$sql = "SELECT * FROM $this->database_table WHERE email=:email";
		$result_sql = $this->connection->prepare($sql);
		$result_sql->execute([':email' => $email]);

		return $result_sql->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Check if user exists in the database, using an email param. Return true/false
	 * @param string $email 
    */
	public function emailExist($email){
		$exist = false;
		$pdo_query = "SELECT * FROM $this->database_table WHERE email=:email";
		$pdo_request = $this->connection->prepare($pdo_query);
		$pdo_request->execute([':email' => $email]);

		$q_res = $pdo_request->fetch(PDO::FETCH_ASSOC);

		if($q_res){			
			$exist = true;
		}

		return $exist;
	}
	
	/**
	 * Insert user into the database
	 * @param string $firstName 
	 * @param string $lastName 
	 * @param string $email 
	 * @param string $password 
    */
	public function insertUserDatabase($firstName, $lastName, $email, $password){
		$pdo_query = "INSERT INTO $this->database_table (firstName, lastName, email, password, created_at, updated_at) VALUES(:firstName, :lastName, :email, :password, now(), now())"; 
	    $pdo_request = $this->connection->prepare($pdo_query);
	    $pdo_request->execute([':firstName' => $firstName, ':lastName' => $lastName, ':email' => $email, ':password' => $password]);

	    $q_res = $pdo_request->fetch(PDO::FETCH_ASSOC);
	   	return $q_res;
	}

	/**
	 * Insert user into the database
	 * @param string $firstName 	 
    */
	public function deleteUserDatabase($email){
		$pdo_query = "DELETE FROM $this->database_table WHERE email=:email_p";
		$pdo_request = $this->connection->prepare($pdo_query);
		$pdo_request->execute([':email_p' => $email]);

		$q_res = $pdo_request->rowCount();

	 return $q_res;

	}


	/**
	 * Update record into the database
	 * @param string $email 
	 * @param string $logged_param 
    */

    public function setUserLogged($email, $logged_param){

    	$pdo_query = "UPDATE $this->database_table SET logged=:logged_param WHERE email=:email_p";
    	$pdo_request = $this->connection->prepare($pdo_query);
    	$pdo_request->execute([':logged_param' => $logged_param, ':email_p' => $email]);

    	$q_res = $pdo_request->rowCount();

     return $q_res;
    }

	/**
	 * Check if our database_schema && database_table exists into mysql information_schema
    */
	public function dataTableExist(){
		// $pdo_query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =:database_name";
		// $pdo_query = "SELECT TABLE_SCHEMA, TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA =:database_name AND TABLE_NAME=:database_table";		
		$pdo_query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA =:database_name AND TABLE_NAME=:database_table";		
		$pdo_request = $this->connection->prepare($pdo_query);
		$pdo_request->execute([':database_name' => $this->database, ':database_table' => $this->database_table]);

		$q_res = $pdo_request->rowCount();
		// var_dump($q_res); exit();
		return $q_res;
	}

	
	/**
	 * Create and initialize database table with admin inserted at creation
    */
	public function createDatabaseTable(){	
		$adminPass = password_hash('pass', PASSWORD_DEFAULT);
		$sql = "CREATE TABLE users (
		  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		  firstName VARCHAR(40) NOT NULL,
		  lastName VARCHAR(40) NOT NULL,
		  email VARCHAR(40) NOT NULL,
		  logged VARCHAR(50),
		  password VARCHAR(99) NOT NULL,
		  reset_string VARCHAR(55),
		  created_at VARCHAR(30),
		  updated_at VARCHAR(30)
	  );

	  INSERT INTO users (firstname, lastName, email, password, created_at, updated_at) VALUES('Administrator', 'Administrator', 'admin@gmail.com', '".$adminPass."', now(), now())";

	    $q_res = $this->connection->exec($sql);
	   	// return $q_res;
	}

}
