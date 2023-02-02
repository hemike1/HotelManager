<?php
// require database.php for connection and data request purposes
require_once 'Database.php';

class Model {

	private $db;

	function __construct($db) {
		$this->db = $db;
	}

	public function login($email, $password) {

	}
}