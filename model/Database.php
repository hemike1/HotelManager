<?php

class Database {

	private $conn;
	private $connection = "localhost";
	private $username = "HMS";
	private $password = "I-e]R*pvkh26!R0G";
	private $dbname = "hms";
	private $prefix = "xcf5_";
	private string $hashKey = "O2/6b6q*kdNzjBZQ";

	public function __construct() {
		$this->conn = new mysqli($this->connection, $this->username, $this->password, $this->dbname);
	}

	//To use "databaseQuery" function as to pull any request from the SQL server
	public function databaseQuery($sqlQuery) {
		$result = $this->conn->query($sqlQuery);
		if($result!=null){
			return $result;
		} else {
			return $hiba = "Hiba volt a lekérdezésben! db.php";
		}
	}

	/*
	Got this from @tokrist. (nah, he wrote it)
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