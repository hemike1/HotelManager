<?php

class HomeController {
	public function home(): void {
		$db = new Database();
		$user = new User($db);
		$user->checkLoggedIn();
		$user->getUserData($_SESSION['id']);

		require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/sidebar.php';
		require_once 'View/Users/home.php';
		require_once 'View/layout/footer.php';
	}
}