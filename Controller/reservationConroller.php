<?php

class reservationConroller {
    public function reservation(): void {
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);

    }
}