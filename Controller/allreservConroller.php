<?php

class allreservConroller {
 public function allReserv(): void {
     $db = new Database();
     $user = new User($db);
     $user->checkLoggedIn();
     $user->getUserData($_SESSION['id']);

 }
}