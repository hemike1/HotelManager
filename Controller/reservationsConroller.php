<?php

class reservationsConroller extends Database {
    public function reservation(): void {

        $title = "Foglalások";
		$db = new Database();
		$user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);
		$user->checkSuperUser();

		require_once 'View/layout/mainHeader.php';
		require_once 'View/layout/sidebar.php';
		require_once 'View/superuser/reservations.php';
		require_once 'View/layout/footer.php';

    }
}