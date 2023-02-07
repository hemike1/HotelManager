<?php

class Database {

	private $conn;
	private $connection = "localhost";
	private $username = "HMS";
	private $password = "I-e]R*pvkh26!R0G";
	private $dbname = "hms";
	private string $hashKey = "O2/6b6q*kdNzjBZQ";

	public function __construct() {
		try{
			$this->conn = new mysqli($this->connection, $this->username, $this->password, $this->dbname);

		} catch (Exception $E){
			echo $E;
		}
		$GLOBALS['prefix'] = "xcf5_";
	}

	//To use "databaseQuery" function as to pull any request from the SQL server
	public function dbQuery($sql) {
		$result = $this->conn->query($sql);
		print_r($result);
		if($result->num_rows > 0){
			return $result;
		} else {
			return "Hiba volt az adatbázissal! db.php";
		}
	}

	public function dbInsert($sql) {
		if($this->conn->query($sql) === true) {return null;}
		else {
			return 'Anyád';
		}
	}

	/*
	Got this from @tokrist. (nah, he wrote it) ((nah its not his))
	*/
	public function passwordHash(string $input):string {
		return password_hash($input, PASSWORD_ARGON2ID, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
	}

	public function encryptData(string $input):string {
		$iv = substr(hash('sha256', $this->hashKey), 0, 16);
		return base64_encode(openssl_encrypt($input, 'AES-256-CBC', $this->hashKey, 0, $iv));
	}

	public function decryptData(string $input):string {
		$iv = substr(hash('sha256', $this->hashKey), 0, 16);
		return openssl_decrypt(base64_decode($input), 'AES-256-CBC', $this->hashKey, 0, $iv);
	}
}