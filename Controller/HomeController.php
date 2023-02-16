<?php

class HomeController {
	public function home() {
		require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/sidebar.php';
		require_once 'View/Users/home.php';
		require_once 'View/layout/footer.php';
	}
}