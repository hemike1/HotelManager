<?php
    class RegisterController {
        public function register(){
            $title = "Regisztrálás";
			$db = new Database();
			$user = new User($db);
			if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password'])) {
				$firstName = $_POST['firstname'];
				$lastName = $_POST['lastname'];
				$email = $_POST['email'];
				$password = $_POST['password'];
				$user->register($firstName, $lastName, $email, $password);
			}
			require_once 'View/layout/loginHeader.php';
            require_once 'View/Users/register.php';
			require_once 'View/layout/footer.php';
        }
    }