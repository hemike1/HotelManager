<?php

require_once 'Model/Database.php';
require_once 'Model/User.php';
$db = new Database();
$user = new User($db);

$action = "";

switch ($action) {
    case 'kilepes':
        session_unset();
        header('location: index.php');
        return "Sikeres kilepes";
        break;
}