<?php

class savedDataController extends Database {
    public function savedData() {
        $title = 'Elmentett adataim';
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);

        $usersReserv = $user->getUsersReservations($_SESSION['id']);
        $usersSavedLoc = $user->getUsersSavedLocation($_SESSION['id']);

        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/sidebar.php';
        require_once 'View/Users/savedData.php';
        require_once 'View/layout/footer.php';
    }
}