<?php

class LoginController {
	public function login() {
		require_once './View/layout/loginHeader.php';
		require_once 'View/Users/login.php';
	}
}