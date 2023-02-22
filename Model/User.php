<?php
require_once 'Database.php';
    class User {
		private $db;
		function __construct($db) {
			$this->db = new Database();
		}

		public function checkLogin($email, $password) {
			$sql = $this->db->prepare('SELECT registeredId, registeredFirstName, registeredEmail, registeredPassword FROM '.$GLOBALS['prefix'].'registered WHERE registeredEmail = ?');
			$enckEm = $this->db->encryptData($email);
			if($sql->bind_param('s', $enckEm)){
				$sql->execute();
				if($result = $sql->get_result()){
					if($result->num_rows > 0){
						$result = $result->fetch_assoc();
						if(!password_verify($password, $result['registeredPassword'])){
							return 1;
						} else {
							return 2;
							$_SESSION['name'] = $result['registeredFirstName'];
							$_SESSION['id'] = $result['registeredId'];
						}
					} else {
						return 0;
					}
				}
			}
		}

        public function register($firstName, $lastName, $email, $password): void {
			$check = $this->db->prepare('SELECT registeredEmail FROM '.$GLOBALS['prefix'].'registered WHERE registeredEmail = ?');
			$checkem = $this->db->encryptData($email);
			print_r($checkem);
			if($check->bind_param('s', $checkem)){
				$check->execute();
				if($result = $check->get_result()){
					if($result->num_rows > 0){
						echo 'Ez az email már használatban van.';
					} else {
						$stmt = $this->db->prepare('INSERT INTO '.$GLOBALS['prefix'].'registered (registeredId, registeredFirstName, registeredLastName, registeredEmail, registeredPassword, registeredPermission) VALUES (null, ?, ?, ?, ?, 1)');
						$fn = $this->db->encryptData($firstName);
						$ln = $this->db->encryptData($lastName);
						$em = $this->db->encryptData($email);
						$pw = $this->db->passwordHash($password);
						$stmt->bind_param('ssss', $fn, $ln, $em, $pw);
						if(!$stmt->execute()){
							trigger_error("there was an error.....".$this->db->conn->error, E_USER_WARNING);
						} else {
							header('Location: /korondi/login');
						}
					}
				}
			}
		}
    }