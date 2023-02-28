<?php
    class User extends Database {

		private $firstname;
		private $lastname;
		private $email;
		private $permission;

		protected String $imgDir = "/korondi/Assets/images/showroom";
		protected String $roomImgDir = "/korondi/Assets/images/rooms";


		public function checkLogin($email, $password) {
			$sql = $this->prepare('SELECT registeredId, registeredFirstName, registeredLastName, registeredEmail, registeredPassword FROM '.$GLOBALS['prefix'].'registered WHERE registeredEmail = ?');
			$enckEm = $this->encryptData($email);
			if($sql->bind_param('s', $enckEm)){
				$sql->execute();
				if($result = $sql->get_result()){
					if($result->num_rows > 0){
						$result = $result->fetch_assoc();
						if(!password_verify($password, $result['registeredPassword'])){
							return 1;
						} else {
							$_SESSION['id'] = $result['registeredId'];
							return 2;
						}
					} else {
						return 0;
					}
				}
			}
		}

        public function register($firstName, $lastName, $email, $password): void {
			$check = $this->prepare('SELECT registeredEmail FROM '.$GLOBALS['prefix'].'registered WHERE registeredEmail = ?');
			$checkem = $this->encryptData($email);
			if($check->bind_param('s', $checkem)){
				$check->execute();
				if($result = $check->get_result()){
					if($result->num_rows > 0){
						echo 'Ez az email már használatban van.';
					} else {
						$stmt = $this->prepare('INSERT INTO '.$GLOBALS['prefix'].'registered (registeredId, registeredFirstName, registeredLastName, registeredEmail, registeredPassword, registeredPermission) VALUES (null, ?, ?, ?, ?, 1)');
						$fn = $this->encryptData($firstName);
						$ln = $this->encryptData($lastName);
						$em = $this->encryptData($email);
						$pw = $this->passwordHash($password);
						$stmt->bind_param('ssss', $fn, $ln, $em, $pw);
						if(!$stmt->execute()){
							trigger_error("there was an error.....".$this->conn->error, E_USER_WARNING);
						} else {
							header('Location: /korondi/login');
						}
					}
				}
			}
		}

		public function getUserData($id): void{
			$sql = $this->prepare('SELECT * FROM '.$GLOBALS['prefix'].'registered WHERE registeredId = ?');
			if($sql->bind_param('i', $_SESSION['id'])){
				$sql->execute();
				if($result = $sql->get_result()){
					if($result->num_rows < 1){
						echo 'Adatbázis hiba!';
					}else{
						$result = $result->fetch_assoc();
						$this->firstname = $this->decryptData($result['registeredFirstName']);
						$this->lastname = $this->decryptData($result['registeredLastName']);
						$this->email = $this->decryptData($result['registeredEmail']);
						$this->permission = $result['registeredPermission'];
					}
				}
			}
		}

		public function uploadImages($imgName, $imgType): void {
			$targetImage = $this->imgDir.$imgName.$imgType;
			if($imgType == ".png"){
				foreach($_FILES['file']['error'] as $key => $error){
					if($error == UPLOAD_ERR_OK){
						move_uploaded_file($imgName, "$this->imgDir/$imgName");
					}
				}
			}
		}

		public function checkLoggedIn(): void {
			if (!isset($_SESSION['id'])) {
				header('Location: /korondi/');
			}
		}

		public function getAllRoomData(): array{
			$response = array();
			$sql = $this->prepare('SELECT * FROM '.$GLOBALS['prefix'].'rooms');
			$sql->execute();
			if($result = $sql->get_result()){
				while($row = $result->fetch_assoc()){
					$temp['roomId'] = $row['roomId'];
					$temp['accomodation'] = $row['roomAccomodation'];
					$temp['size'] = $row['roomSize'];
					$temp['floor'] = $row['roomFloor'];
					$temp['number'] = $row['roomNumber'];
					$temp['image'] = $row['roomImageName'];
					$temp['description'] = $row['roomDescription'];
					$response[] = $temp;
				}
			}
			return $response;
		}

		/**
		 * @return mixed
		 */
		public function getFirstname() {
			return $this->firstname;
		}

		/**
		 * @return mixed
		 */
		public function getLastname() {
			return $this->lastname;
		}

		/**
		 * @return mixed
		 */
		public function getEmail() {
			return $this->email;
		}

		/**
		 * @return mixed
		 */
		public function getPermission() {
			return $this->permission;
		}

		public function getRoomImgDir(): string {
			return $this->roomImgDir;
		}
    }