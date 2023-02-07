<?php
require_once 'Database.php';
    class User {
		private $db;
		function __construct($db) {
			$this->db = new Database();
		}

		public function checkLogin($email, $password) {
			$sql = 'SELECT registeredId, registeredFirstName, registeredEmail, registeredPassword FROM '.$GLOBALS['prefix'].'registered WHERE registeredEmail = "'.$email.'"';
			if($result = $this->db->dbQuery($sql)){
				if($row = $result->fetch_assoc()){
					if($row['registeredPassword'] === $password){
						$_SESSION['name'] = $row['registeredFirstName'];
						$_SESSION['id'] = $row['registeredId'];
						$eredmeny = 2;
					} else {
						$eredmeny = 1;
					}
				} else {
					$eredmeny = 0;
				}
				return $eredmeny;
			}
		}



        public function register($firstName, $lastName, $email, $password) {
			$stmt = $this->db->prepare('INSERT INTO '.$GLOBALS['prefix'].'registered(registeredId, registeredFirstName, registeredLastName, registeredEmail, registeredPassword, registeredPermission) VALUES
			(null, ?, ?, ?, ?, 1)');
			$stmt->bind_param("ssss", $firstName, $lastName, $email, $password);
			$firstName = $_POST['firstname'];
			$lastName = $_POST['lastname'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$stmt->execute();
        }
    }