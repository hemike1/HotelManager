<?php

class usermgmtConroller {
    public function userMgmt(): void {
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);

    }
}