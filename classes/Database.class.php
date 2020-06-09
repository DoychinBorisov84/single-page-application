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
		$this->connection = new PDO("mysql:host=localhost;dbname=single_page_application", "root", "root");	
			 // die(json_encode(array('outcome' => true)));
		}catch(PDOException $e){
			echo $e->getMessage();
			// die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
		}		
	}

	// public function getX(){
	// 	// return $this->connection;
	// 	// return 'Data: '. var_dump($this->connection);
	// }

	public function selectUserFromDatabase($email){
		$sql = "SELECT * FROM $this->database_table WHERE email=:email";
		$result_sql = $this->connection->prepare($sql);
		$result_sql->execute([':email' => $email]);

		return $result_sql->fetch(PDO::FETCH_ASSOC);
	}

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
	

	public function insertUserDatabase($firstName, $lastName, $email, $password){
		$pdo_query = "INSERT INTO $this->database_table (firstName, lastName, email, password, created_at, updated_at) VALUES(:firstName, :lastName, :email, :password, now(), now())"; 
	    $pdo_request = $this->connection->prepare($pdo_query);
	    $pdo_request->execute([':firstName' => $firstName, ':lastName' => $lastName, ':email' => $email, ':password' => $password]);

	    $q_res = $pdo_request->fetch(PDO::FETCH_ASSOC);
	   	return $q_res;
	}



	public function dataTableExist(){

	}

	// public function selectQuery(){

	// }

	// public function createDatabaseTable(){	
	// 	$sql_create_table = "CREATE TABLE users (
	// 	  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	// 	  firstName VARCHAR(40) NOT NULL,
	// 	  lastName VARCHAR(40) NOT NULL,
	// 	  email VARCHAR(40) NOT NULL,
	// 	  logged VARCHAR(50),
	// 	  password VARCHAR(99) NOT NULL,
	// 	  reset_string VARCHAR(55),
	// 	  created_at VARCHAR(30),
	// 	  updated_at VARCHAR(30)
	//   );
	//   INSERT INTO users (firstname, lastName, email, password, created_at, updated_at) VALUES('Administrator', 'Administrator', 'admin@gmail.com', '".$this->admin_pass."', now(), now())";
	// }


	// $connection = null;
}
