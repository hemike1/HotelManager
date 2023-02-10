<?php

class LoginController {
	public function login() {
        $title = "Bejelentkezés";
		require_once 'View/layout/loginHeader.php';
		require_once 'View/Users/login.php';
        require_once 'View/layout/footer.php';
	}
}