<?php
require_once 'Database.php';
    class User {
		private $db;
		function __construct($db) {
			$this->db = $db;
		}

		public function checkLogin($email, $password) {
            if(isset($_POST['email']) && isset($_POST['password'])) {
                $sql = 'SELECT registeredEmail, registeredPassword FROM '.$GLOBALS['prefix'].'registered 
                WHERE registeredEmail = '.$_POST['email'];

                if($result = $this->db->dbQuery($sql)) {
                    if($row = $result->fetch_assoc()) {
                        if($row['registeredPassword'] == passwordHash($password)) {
                            $errorCode = 2; // Successful login
                            $_SESSION['name'] = $row['registeredFirstName'];
                            $_SESSION['id'] = $row['registeredId'];
                        } else {
                            $errorCode = 1; // Unsuccessful login: bad password
                        }
                    }
                } else {
                    $errorCode = 0; //Unsuccessful login: no such email in database
                }
                return $errorCode;
            }
        }


        public function register($firstName, $lastName, $email, $password) {
			$stmt = $this->db->dbInsert->prepare('INSERT INTO '.$GLOBALS['prefix'].'registered(registeredId, registeredFirstName, registeredLastName, registeredEmail, registeredPassword, registeredPermission) VALUES
			(null, ?, ?, ?, ?, 1)');
			$stmt->bind_params("ssss", $firstName, $lastName, $email, $password);
			$firstName = $_POST['firstname'];
			$lastName = $_POST['lastname'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$stmt->execute();
        }
    }