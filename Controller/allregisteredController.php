<?php

class allregisteredController {

	public function allRegistered(): void {
		$title = "Regisztráltak";
		$db = new Database();
		$user = new User($db);
		$user->checkLoggedIn();
		$user->getUserData($_SESSION['id']);
		$getuser = $user->getAllUser();


		if ($user->getPermission() == 3) {
			require_once 'View/layout/mainHeader.php';
			require_once 'View/layout/sidebar.php';
			require_once 'View/admin/registeredUsers.php';
			require_once 'View/layout/footer.php';
		} else {
			header('Location: /korondi/errors/noAccess');
		}
	}
}