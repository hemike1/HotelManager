<?php

class Room extends Database {

	protected String $imgDir = "/korondi/Assets/images/showroom";
	protected String $roomImgDir = "/korondi/Assets/images/rooms";

	public function getAllRoomData(): array{
		$response = array();
		$sql = $this->prepare('SELECT * FROM '.$GLOBALS['prefix'].'rooms INNER JOIN '.$GLOBALS['prefix'].'features ON roomFeatures = featureId');
		$sql->execute();
		if($result = $sql->get_result()){
			while($row = $result->fetch_assoc()){
				$temp['roomId'] = $row['roomId'];
				$temp['accomodation'] = $row['roomAccomodation'];
				$temp['size'] = $row['roomSize'];
				$temp['floor'] = $row['roomFloor'];
				$temp['number'] = $row['roomNumber'];
				$temp['image'] = $row['roomImageName'];
				$temp['features'] = $row['featureIcon'];
				$temp['price'] = $row['roomPrice'];
				$temp['description'] = $row['roomDescription'];
				$response[] = $temp;
			}
		}
		return $response;
	}

	public function createNewRoom($accom, $size, $floor, $number, $imgName, $features, $price, $desc): void {
		$sql = $this->prepare('INSERT INTO '.$GLOBALS['prefix'].'rooms(roomAccomodation, roomSize, roomFloor, roomNumber, roomImageName, roomFeatures, roomPrice, roomDescription) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
		if($sql->bind_param('isiisiis', $accom, $size, $floor, $number, $imgName, $features, $price, $desc)){
			$sql->execute();
		}
	}

	public function moveUploadedFile($imageID): void {
		$upload_dir = '/var/www/clients/client31/web184/web/korondi/Assets/images/rooms';
		if($_FILES[$imageID]['error'] === UPLOAD_ERR_OK){
			$tmp_name = $_FILES[$imageID]["tmp_name"];
			$name = $_FILES[$imageID]["name"];
			move_uploaded_file($tmp_name, "$upload_dir/$name");
		}
	}

	public function getRoomImgDir(): string {
		return $this->roomImgDir;
	}

}