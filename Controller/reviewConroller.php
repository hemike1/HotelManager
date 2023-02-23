<?php

class reviewConroller {
    public function review(): void {
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);

    }
}