<?php
require 'Database.class.php';

class User extends Database{

	private $firstName;
	private $lastName;
	private $email;
	private $password;

	public function __construct($firstName, $lastName, $email, $password){
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		// $this->password = $password;
		$this->password = password_hash($password, PASSWORD_DEFAULT);

		parent::__construct();
	}

	function getUserRecord($email){
		return $this->selectUserFromDatabase($email);
	}

	public function userExist($email){
		// var_dump($this->email);exit();
		return $this->emailExist($this->email);
	}

	public function userCreate($firstName, $lastName, $email, $password){
		return $this->insertUserDatabase($this->firstName, $this->lastName, $this->email, $this->password);
	}

	public function databaseExist(){
		return $this->dataTableExist();
	}

	public function createDatabase(){
		return $this->createDatabaseTable();
	}

	// public function test(){
	// 	return $this->getx();	// parent
	// }

	// public function saveUserDb(){

	// }
}