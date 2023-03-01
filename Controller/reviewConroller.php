<?php

class reviewConroller extends Database {
    public function review(): void {
        $title = "Értékeljen!";
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);


        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/sidebar.php';

        require_once 'View/layout/footer.php';
    }
}