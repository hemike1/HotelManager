<?php

class AdminController extends Database {

    public function allRegistered(): void {
        $title = "Regisztráltak";
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);
        $getuser = $user->getAllUser();
        $user->checkAdmin();

        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/sidebar.php';
        require_once 'View/admin/registeredUsers.php';
        require_once 'View/layout/footer.php';

    }

    public function allReserv(): void {

        $title = "Összes foglalás";

        $db = new Database();
        $user = new User($db);

        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);

        if ($user->getPermission() == 3) {
            require_once 'View/layout/mainHeader.php';
            require_once 'View/layout/sidebar.php';
            require_once 'View/admin/allreserv.php';
            require_once 'View/layout/footer.php';
        } else {
            require_once 'View/errors/403.php';
        }
    }

    public function newroom() {
        $title = "Új szoba hozzáadása";
        $imageID = 'formFile';
        $db = new Database();
        $user = new User($db);
        $room = new Room();
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);
        $user->checkAdmin();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $accom = $_POST['formAcc'];
            $size = $_POST['formSize'];
            $floor = $_POST['formRoomFloor'];
            $number = $_POST['formRoomNum'];
            $imgName = $_FILES[$imageID]["name"];
            $features = $_POST['formIconOptions'];
            $price = $_POST['formRoomPrice'];
            $desc = $_POST['formRoomDescription'];
            $room->createNewRoom($accom, $size, $floor, $number, $imgName, $features, $price, $desc);
            $room->moveUploadedFile($imageID);
        }

        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/sidebar.php';
        require_once 'View/admin/newroom.php';
        require_once 'View/layout/footer.php';
    }

    public function reservation(): void {

        $title = "Foglalások";
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);
        $user->checkSuperUser();

        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/sidebar.php';
        require_once 'View/superuser/reservations.php';
        require_once 'View/layout/footer.php';

    }

    public function userMgmt(): void {
        $title = "Felhasználó kezelés";
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);
        $user->checkAdmin();

        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/sidebar.php';
        require_once 'View/admin/usermgmt.php';
        require_once 'View/layout/footer.php';

    }
}