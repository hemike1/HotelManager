<?php

class contactsController extends Database {
    public function contacts() {
        $title = "Elérhetőségek";
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);

        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/testsidebar.php';

        require_once 'View/layout/footer.php';
    }
}