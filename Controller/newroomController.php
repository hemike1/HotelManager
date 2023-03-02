<?php

class newroomController extends Database {

    public function newroom() {
        $title = "Új szoba hozzáadása";
        $db = new Database();
        $user = new User($db);
        $user->checkLoggedIn();
        $user->getUserData($_SESSION['id']);

        if($user->getPermission() === 3){
            require_once 'View/layout/mainHeader.php';
            require_once 'View/layout/sidebar.php';
            require_once 'View/admin/newroom.php';
            require_once 'View/layout/footer.php';
        } else {
            header('Location: /korondi/home');
        }

        $accom = $_POST['formAcc'];
        $size = $_POST['formSize'];
        $floor = $_POST['formRoomFloor'];
        $number = $_POST['formRoomNum'];
        $imgName = $_FILES['formFile']['name'];
        $features = $_POST['formIconOptions'];
        $desc = $_POST['formRoomDescription'];

        $user->createNewRoom($accom, $size, $floor, $number, $imgName, $features, $desc);

    }
}