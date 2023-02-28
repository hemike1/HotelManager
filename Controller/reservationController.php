<?php

class reservationController extends Database {
	public function reservation() {
		$title = "Szobafoglalás";
		$db = new Database();
		$user = new User($db);
		$user->checkLoggedIn();
		$user->getUserData($_SESSION['id']);
		$rooms = $user->getAllRoomData();


		require_once 'View/layout/mainHeader.php';
		require_once 'View/layout/testsidebar.php';
		require_once 'View/Users/reservation.php';
		require_once 'View/layout/footer.php';
	}
}