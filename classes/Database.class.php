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
	private $counter_table = 'user_counter';
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
	 * Select user from the database, using firstName as parameter. Returns user as AssocArray	
	 * @param string $email 
    */
    public function selectUserByName($name){
    	$sql = "SELECT firstName, lastName, image FROM $this->database_table WHERE firstName=:name";
    	$result_sql = $this->connection->prepare($sql);
    	$result_sql->execute([':name' => $name]);

    	return $result_sql->fetch(PDO::FETCH_ASSOC);
    }

	/**
	 * Select All users from the database. Returns user as AssocArray	
	 * @param string $ 
    */
	public function selectUsersAll(){
		$sql = "SELECT * FROM $this->database_table ORDER BY ID";
		$result_sql = $this->connection->query($sql, PDO::FETCH_ASSOC);

		$users = array();
		foreach ($result_sql as $user) {			
			array_push($users, $user);
		}
		// var_dump($users);
	 return $users;
	}

	/**
	 * Select user from the database, using an email as parameter. Returns user as AssocArray	
	 * @param string $reset_string 
    */
	public function selectUserResetstring($reset_string){

		$pdo_query = "SELECT * FROM $this->database_table WHERE reset_string=:reset_string";
		$pdo_request = $this->connection->prepare($pdo_query);
		$pdo_request->execute([':reset_string' => $reset_string]);

		$q_res = $pdo_request->fetch(PDO::FETCH_ASSOC);

		return $q_res;
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
	 * @param string $email 	 
    */
	public function deleteUserDatabase($email){
		$pdo_query = "DELETE FROM $this->database_table WHERE email=:email_p";
		$pdo_request = $this->connection->prepare($pdo_query);
		$pdo_request->execute([':email_p' => $email]);

		$q_res = $pdo_request->rowCount();

	 return $q_res;

	}

	/**
	 * Update user into the database
	 * @param string $firstName 	 
	 * @param string $lastName 	 
	 * @param string $email 	 
    */
	public function updateUserDatabase($firstName, $lastName, $updated_at, $email){

		$pdo_query = "UPDATE $this->database_table SET firstName=:firstName, lastName=:lastName, updated_at=:updated_at WHERE email=:email";
		$pdo_request = $this->connection->prepare($pdo_query);
		$pdo_request->execute([':firstName' => $firstName, ':lastName' => $lastName, ':updated_at' => $updated_at, ':email' => $email]);

		$q_res = $pdo_request->rowCount();

	 return $q_res;
	}

	/**
	 * Update user password into the database
	 * @param string $pass 	 	  
	 * @param string $id 	 	  
    */
    public function updateUserPassword($pass, $id){

    	$pdo_query = "UPDATE $this->database_table SET password=:pass WHERE id=:id";
    	$pdo_request = $this->connection->prepare($pdo_query);
    	$pdo_request->execute([':pass' => $pass, 'id' => $id]);

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
	 * Update user reset_string field the database
	 * @param string $firstName 	 
	 * @param string $lastName 	 
	 * @param string $email 	 
    */
    public function setUserResetString($reset_string, $email){

    	$pdo_query = "UPDATE $this->database_table SET reset_string=:reset_string WHERE email=:email";
    	$pdo_request = $this->connection->prepare($pdo_query);
    	$pdo_request->execute([':reset_string' => $reset_string, ':email' => $email]);

    	$q_res = $pdo_request->rowCount();

	 return $q_res;
    }

      /**
	 * Save uploaded img to the database
	 * @param string $img 	
    */
      public function saveImg($img, $email){
      	$pdo_query = "UPDATE $this->database_table SET image=:img WHERE email=:email";
      	$pdo_request = $this->connection->prepare($pdo_query);
      	$pdo_request->execute(['img' => $img, 'email' => $email]);

      	$q_res = $pdo_request->rowCount();

      return $q_res;
      }


      /**
	 * Save the liked user name data into the database
	 * @param string $user_id, string $visiter_ip	
	 * return rows affected
    */
      public function likeUser($user_id, $visiter_ip){
      	$pdo_query = "INSERT INTO $this->counter_table (user_id, visiter_ip, created_at) VALUES(:user_id, :visiter_ip, now() ) ";
      	$pdo_request = $this->connection->prepare($pdo_query);
      	$pdo_request->execute(['user_id' => $user_id, 'visiter_ip' => $visiter_ip]);

      	$q_res = $pdo_request->rowCount();
      	// var_dump($q_res);
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
		  image VARCHAR(100),
		  created_at VARCHAR(30),
		  updated_at VARCHAR(30)
	  );

	  INSERT INTO users (firstname, lastName, email, password, created_at, updated_at) VALUES('Administrator', 'Administrator', 'admin@gmail.com', '".$adminPass."', now(), now())";

	    $q_res = $this->connection->exec($sql);
	   	// return $q_res;
	}

}