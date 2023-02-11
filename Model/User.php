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
            //check if someone's using this email
            $check = $this->db->prepare('SELECT registeredEmail FROM '.$GLOBALS['prefix'].'registered WHERE registeredEmail = ?');
            if(!$check) {
                return "Hiba: ". $this->db->error;
            }
            $check->bind_param("s", $email);
            $check->execute();
            if($check->num_rows > 0) {
                return 1;
            } else { // if user doesnt exist, register
                $sql = $this->db->prepare('INSERT INTO '.$GLOBALS['prefix'].'registered(registeredId, registeredFirstName, registeredLastName, registeredEmail, registeredPassword, registeredPermission) VALUES (null, ?, ?, ?, ?, 1)');
                if(!$sql) {
                    return "Error: ". $sql->db->error; //
                }
                $sql->bind_param("ssss", $firstName, $lastName, $email, $password);
                if($sql->execute()){
                    return "Regisztráció sikeres!";
                }
            }
        }
    }