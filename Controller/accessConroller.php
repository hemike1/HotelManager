<?php

class accessConroller {
    public function access(): void{
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);

    }
}