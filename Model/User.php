<?php
require_once 'Database.php';
    class User {

		private $firstname;
		private $lastname;
		private $email;
		private $permission;
		private $db;



		function __construct($db) {
			$this->db = new Database();
		}



		public function checkLogin($email, $password) {
			$sql = $this->db->prepare('SELECT registeredId, registeredFirstName, registeredLastName, registeredEmail, registeredPassword FROM '.$GLOBALS['prefix'].'registered WHERE registeredEmail = ?');
			$enckEm = $this->db->encryptData($email);
			if($sql->bind_param('s', $enckEm)){
				$sql->execute();
				if($result = $sql->get_result()){
					if($result->num_rows > 0){
						$result = $result->fetch_assoc();
						if(!password_verify($password, $result['registeredPassword'])){
							return 1;
						} else {
							$_SESSION['id'] = $result['registeredId'];
							return 2;
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

		public function getUserData($id){
			$sql = $this->db->prepare('SELECT * FROM '.$GLOBALS['prefix'].'registered WHERE registeredId = ?');
			if($sql->bind_param('i', $_SESSION['id'])){
				$sql->execute();
				if($result = $sql->get_result()){
					if($result->num_rows < 1){
						echo 'Adatbázis hiba!';
					}else{
						$result = $result->fetch_assoc();
						$this->firstname = $this->db->decryptData($result['registeredFirstName']);
						$this->lastname = $this->db->decryptData($result['registeredLastName']);
						$this->email = $this->db->decryptData($result['registeredEmail']);
						$this->permission = $result['registeredPermission'];
					}
				}
			}
		}

		public function checkLoggedIn(): void {
			if (!isset($_SESSION['id'])) {
				header('Location: /korondi/');
			}
		}

		/**
		 * @return mixed
		 */
		public function getFirstname() {
			return $this->firstname;
		}

		/**
		 * @return mixed
		 */
		public function getLastname() {
			return $this->lastname;
		}

		/**
		 * @return mixed
		 */
		public function getEmail() {
			return $this->email;
		}

		/**
		 * @return mixed
		 */
		public function getPermission() {
			return $this->permission;
		}
    }