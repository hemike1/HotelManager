<?php

class UserController extends Database {

    public function savedData() {
        $title = 'Elmentett adataim';
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);

        $usersReserv = $user->getUsersReservations($_SESSION['id']);
        $usersSavedLoc = $user->getUsersSavedLocation($_SESSION['id']);

        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/sidebar.php';
        require_once 'View/Users/savedData.php';
        require_once 'View/layout/footer.php';
    }

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

    public function reservation() {
        $title = "Szobafoglalás";
        $db = new Database();
        $user = new User($db);
        $room = new Room();
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);
        $rooms = $room->getAllRoomData();

        $locations = $user->getSavedLocations($_SESSION['id']);
        $cities = $user->getAllCities();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newLocCityId = $_POST['cityandpostnum'];
            $newLocStrName = $_POST['strname'];
            $newLocHouseNum = $_POST['houseNumber'];
            $addResRoomId = $_POST['reservRoomId'];
            $addResStartDate = $_POST['reservStartDate'];
            $addResEndDate = $_POST['reservEndDate'];
            $user->newFullReservation($newLocCityId, $newLocStrName, $newLocHouseNum, $addResRoomId, $addResStartDate, $addResEndDate);
        }

        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/sidebar.php';
        require_once 'View/Users/reservation.php';
        require_once 'View/layout/footer.php';
    }

    public function profile() {
        $title = 'Profilom';
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);

        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/sidebar.php';
        require_once 'View/Users/profile.php';
        require_once 'View/layout/footer.php';
    }

    public function images(): void {
        $title = "Képek";
        $imageID = 'uploadShowroom';
        $db = new Database();
        $user = new User($db);
        $admin = new Admin();
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);

        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/sidebar.php';
        require_once 'View/Users/images.php';
        require_once 'View/layout/footer.php';

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $admin->moveShowroomImage($imageID);
        }
    }

    public function home(): void {
        $title = 'Főoldal';
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);

        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/sidebar.php';
        require_once 'View/Users/home.php';
        require_once 'View/layout/footer.php';
    }

    public function contacts() {
        $title = "Elérhetőségek";
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);

        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/sidebar.php';

        require_once 'View/layout/footer.php';
    }

    public function access(): void{
        $title = "Akadálymentesítés";
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);


        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/sidebar.php';

        require_once 'View/layout/footer.php';


    }
}