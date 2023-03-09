<?php

class LoginController extends Database {
	public function login() {
        $title = "Bejelentkezés";
		$db = new Database();
		$user = new User($db);
        if(isset($_SESSION['id'])){
            header('Location: /korondi/home');
        } else if(isset($_POST['email']) && isset($_POST['password'])) {
			$response = $user->checkLogin($_POST['email'], $_POST['password']);
            if(!empty($response)){
                foreach ($response as $key => $value){
                    $$key = $value;
                }
            } else {
                header('Location: /korondi/home');
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