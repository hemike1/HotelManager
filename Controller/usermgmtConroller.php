<?php

class usermgmtConroller extends Database {
    public function userMgmt(): void {
        $title = "Felhasználó kezelés";
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);



        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/testsidebar.php';

        require_once 'View/layout/footer.php';
    }
}