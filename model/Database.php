<?php

class Database {

	private $db;
	private $connection = "localhost";
	private $username = "HMS";
	private $password = "I-e]R*pvkh26!R0G";
	private $dbname = "hms";
	private $prefix = "xc5_";
	public function __construct(){
		$this->db = new mysqli($this->connection, $this->username, $this->password, $this->dbname);
	}

	public function getUsers(){
		$query = "SELECT * FROM".$this->prefix."registered";
		$result = $this->db->query($query);
		return $result->fetch_all(MYSQLI_ASSOC);
	}
	
}