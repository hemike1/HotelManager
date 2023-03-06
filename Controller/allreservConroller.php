<?php

class allreservConroller extends Database {
    public function allReserv(): void {

        $title = "Összes foglalás";

        $db = new Database();
        $user = new User($db);

        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);

        if ($user->getPermission() == 3) {
            require_once 'View/layout/mainHeader.php';
            require_once 'View/layout/sidebar.php';
            require_once 'View/admin/allreserv.php';
            require_once 'View/layout/footer.php';
        } else {
            require_once 'View/errors/403.php';
        }
    }
}