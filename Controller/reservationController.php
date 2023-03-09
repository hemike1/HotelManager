<?php

class reservationController extends Database {
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

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($_POST['billingData'] === "new" && $_POST['billingData'] === ""){
                $newLocCityId = $_POST['billingData'];
                $newLocStrName = $_POST['strname'];
                $newLocHouseNum = $_POST['housenum'];
                if(isset($_POST['reservStartDate']) && isset($_POST['reservEndDate'])){
                    $addResRoomId = $_POST['reservRoomId'];
                    $addResStartDate = $_POST['reservStartDate'];
                    $addResEndDate = $_POST['reservEndDate'];
                    $user->newFullReservation($newLocCityId, $newLocStrName, $newLocHouseNum, $addResRoomId, $addResStartDate, $addResEndDate);
                }
            }
        }



		require_once 'View/layout/mainHeader.php';
		require_once 'View/layout/sidebar.php';
		require_once 'View/Users/reservation.php';
		require_once 'View/layout/footer.php';
	}
}