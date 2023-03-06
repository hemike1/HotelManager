<?php

class newroomController extends Database {

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
			print_r($_FILES['formFile']);
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
			echo $_FILES["$imageID"]["name"];
		}

        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/sidebar.php';
        require_once 'View/admin/newroom.php';
        require_once 'View/layout/footer.php';


    }
}