<?php

class imagesConroller {
    public function images(): void {
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);

    }
}