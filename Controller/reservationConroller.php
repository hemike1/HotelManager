<?php

class reservationConroller extends Database {
    public function reservation(): void {

        $title = "Foglalások";
		$db = new Database();
		$user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);




        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/testsidebar.php';
        require_once 'View/superuser/reservations.php';
        require_once 'View/layout/footer.php';
    }
}