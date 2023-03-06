<?php

class Admin extends Database {

	public function moveShowroomImage($imageID): void {
		$upload_dir = '/var/www/clients/client31/web184/web/korondi/Assets/images/showroom';
		if($_FILES[$imageID]['error'] === UPLOAD_ERR_OK){
			$tmp_name = $_FILES[$imageID]["tmp_name"];
			$name = $_FILES[$imageID]["name"];
			move_uploaded_file($tmp_name, "$upload_dir/$name");
		}
	}

}