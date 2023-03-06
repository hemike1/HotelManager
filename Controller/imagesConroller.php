<?php

class imagesConroller extends Database {
    public function images(): void {
        $title = "Képek";
		$imageID = 'uploadShowroom';
        $db = new Database();
        $user = new User($db);
		$admin = new Admin();
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);

        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/sidebar.php';
		require_once 'View/Users/images.php';
        require_once 'View/layout/footer.php';

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$admin->moveShowroomImage($imageID);
		}
    }
}