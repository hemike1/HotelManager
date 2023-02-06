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

                if($result = $this->db->databaseQuery($sql)) {
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
            if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password'])){
                $sql = 'INSERT INTO '.$GLOBALS['prefix'].'registered 
                (registeredId, registeredFirstName, registeredLastName, registeredEmail, registeredPassword, registeredPermission) VALUES
                (null, $firstname, $lastname, $email, $password, 1)';
            }
        }

    }
