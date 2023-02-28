<?php

class reservationController extends Database {
	public function reservation() {
		$db = new Database();
		$user = new User($db);


		require_once 'View/layout/mainHeader.php';
		require_once 'View/layout/testsidebar.php';
		require_once 'View/Users/reservation.php';
		require_once 'View/layout/footer.php';
	}
}