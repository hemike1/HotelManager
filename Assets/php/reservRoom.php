<?php
require_once '/var/www/clients/client31/web184/web/korondi/Model/Database.php';

$db = new Database();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['roomId'])) {
	$sql = $db->prepare('SELECT * FROM '.$GLOBALS['prefix'].'rooms INNER JOIN '.$GLOBALS['prefix'].'features ON roomFeatures = featureId WHERE roomId = ?');
	if ($sql->bind_param('i', $_POST['roomId'])) {
		$sql->execute();
		if ($result = $sql->get_result()) {
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$response['roomId'] = $row['roomId'];
				$response['accomodation'] = $row['roomAccomodation'];
				$response['size'] = $row['roomSize'];
				$response['floor'] = $row['roomFloor'];
				$response['number'] = $row['roomNumber'];
				$response['image'] = $row['roomImageName'];
				$response['features'] = $row['featureIcon'];
				$response['price'] = $row['roomPrice'];
				$response['description'] = $row['roomDescription'];
				print_r(json_encode($response));
			}
		}
	}
}