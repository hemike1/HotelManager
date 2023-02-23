<?php

class LoginController {
	public function login() {

		$db = new Database();
		$user = new User($db);

		if(isset($_POST['email']) && isset($_POST['password'])) {
			$login = $user->checkLogin($_POST['email'], $_POST['password']);
			switch($login){
				case 0:
					echo 'Nincs ilyen email';
					break;
				case 1:
					echo 'Sikertelen belépés, hibás adatok.';
					break;
				case 2:
					echo 'Sikeres bejelentkezés';
					header('Location: /korondi/home');
					break;
			}
		}
		require_once 'View/layout/loginHeader.php';
		require_once 'View/Users/login.php';
        require_once 'View/layout/footer.php';
	}
	public function logout(){

		session_destroy();
		header('Location: /korondi/');

	}
}