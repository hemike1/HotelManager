<?php

class ErrorController extends Database {
    public function notFound() {
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);
        http_response_code(404);
        include('View/errors/404.php');
    }

    public function noAccess() {
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);
        http_response_code(403);
        include('View/errors/403.php');
    }
}