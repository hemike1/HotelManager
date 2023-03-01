<?php

class newroomController extends Database {

    public function newroom() {
        $title = "Új szoba hozzáadása";
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);

        if($user->getPermission() === 3){
            require_once 'View/layout/mainHeader.php';
            require_once 'View/layout/sidebar.php';
            require_once 'View/admin/newroom.php';
            require_once 'View/layout/footer.php';
        }
    }
}