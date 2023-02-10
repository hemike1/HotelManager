<?php
require_once 'Database.php';
    class User {
		private $db;
		function __construct($db) {
			$this->db = new Database();
			$asd = "+kljhsadf";
		}

		public function checkLogin($email, $password) {
			$sql = 'SELECT registeredId, registeredFirstName, registeredEmail, registeredPassword FROM '.$GLOBALS['prefix'].'registered WHERE registeredEmail = "'.$this->db->encryptData($email).'"';
			if($result = $this->db->dbQuery($sql)){
				if($row = $result->fetch_assoc()){
					$registeredEmail = $this->db->decryptData($row['registeredEmail']);
					$registeredPassword = $this->db->decryptData($row['registeredPassword']);
					print_r($registeredEmail, $registeredPassword);
					if($this->db->decryptData($row['registeredPassword']) === $password){
						$_SESSION['name'] = $this->db->decryptData($row['registeredFirstName']);
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
			$stmt = $this->db->prepare('INSERT INTO '.$GLOBALS['prefix'].'registered(`registeredId`, `registeredFirstName`, `registeredLastName`, `registeredEmail`, `registeredPassword`, `registeredPermission`) VALUES (null, ?, ?, ?, ?, 1)');
			$stmt->bind_param("ssss", $firstName, $lastName, $email, $password);
			$firstName = $this->db->encryptData($_POST['firstname']);
			$lastName = $this->db->encryptData($_POST['lastname']);
			$email = $this->db->encryptData($_POST['email']);
			$password = $this->db->encryptData($_POST['password']);
			$stmt->execute();
        }
    }