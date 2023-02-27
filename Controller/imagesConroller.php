<?php

class imagesConroller extends Database {
    public function images(): void {
        $title = "Képek";
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);

		if($user->getPermission() == 3){
			$uploadPriv = 1;
		}

        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/testsidebar.php';
		require_once 'View/Users/images.php';
        require_once 'View/layout/footer.php';
    }
}