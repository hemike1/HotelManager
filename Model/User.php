<?php
    class User extends Database {

		private $firstname;
		private $lastname;
		private $email;
		private $permission;




		public function checkLogin($email, $password): array {
			$sql = $this->prepare('SELECT registeredId, registeredEmail, registeredPassword FROM '.$GLOBALS['prefix'].'registered WHERE registeredEmail = ?');
			$enckEm = $this->encryptData($email);
			if($sql->bind_param('s', $enckEm)){
				$sql->execute();
				if($result = $sql->get_result()){
					if($result->num_rows > 0){
						$result = $result->fetch_assoc();
						if(!password_verify($password, $result['registeredPassword'])){
							return array("error_password" => "Hibás jelszó!"); //hibás jelszó
						} else {
							$_SESSION['id'] = $result['registeredId'];
							return array();
						}
					}
				}
                return array("error_email" => "Hibás email!");
			}
            //return array("error_email" => "Hibás email!", "error_password" => "Hibás jelszó!");
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
							//trigger_error("there was an error.....".$this->conn->error, E_USER_WARNING);

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
				http_response_code(403);
				header('Location: /korondi/');
			}
		}

		public function getAllUser(): array {
			$sql = $this->prepare('SELECT * FROM '.$GLOBALS['prefix'].'registered');
			$sql->execute();
			if($result = $sql->get_result()){
				while($row = $result->fetch_assoc()){
					$temp['id'] = $row['registeredId'];
					$temp['fn'] = $this->decryptData($row['registeredFirstName']);
					$temp['ln'] = $this->decryptData($row['registeredLastName']);
					$temp['email'] = $this->decryptData($row['registeredEmail']);
					$temp['perm'] = $row['registeredPermission'];
					$response[] = $temp;
				}
			}
			return $response;
		}

		public function getSavedLocations($id){
			$response = array();
			$sql = $this->prepare('SELECT * FROM '.$GLOBALS['prefix'].'savedLocations WHERE savedLocationRegisteredId = ?');
			if($sql->bind_param('i', $id)) {
				$sql->execute();
				if($result = $sql->get_result()){
					if($result->num_rows > 0){
						$row = $result->fetch_assoc();
						$sql2 = $this->prepare('SELECT * FROM '.$GLOBALS['prefix'].'cities WHERE cityId = ?');
						$sql2->bind_param('i', $row['savedLocationCityId']);
						$sql2->execute();
						if($result2 = $sql2->get_result()){

							$row2 = $result2->fetch_assoc();

							$temp['id'] = $row['savedLocationId'];
							$temp['postNum'] = $row2['cityPostNum'];
							$temp['cityName'] = $row2['cityName'];
							$temp['streetName'] = $row['savedLocationStrName'];
							$temp['houseNum'] = $row['savedLocationHouseNum'];
							$response[] = $temp;
						} else {
							return $vaneCity = true;
						}
					}
				}
			}
			return $response;
		}

		public function getAllCities(): array{
			$response = array();
			$sql = $this->prepare('SELECT * FROM '.$GLOBALS['prefix'].'cities');
			$sql->execute();
			if($result = $sql->get_result()){
				if($result->num_rows>0){
					while($row = $result->fetch_assoc()) {
                        $temp['id'] = $row['cityId'];
                        $temp['postNum'] = $row['cityPostNum'];
                        $temp['cityName'] = $row['cityName'];
                        $response[] = $temp;
                    }
				}
			}
		return $response;
		}

		public function checkSuperUser(): void {
			if($this->permission >= 2){
				http_response_code(403);
				require_once 'View/errors/403.php';
				exit;
			}
		}

		public function checkAdmin(): void {
			if($this->permission !== 3){
				http_response_code(403);
				require_once 'View/errors/403.php';
				exit;
			}
		}

        public function newSavedLocation($newLocCityId, $newLocStrName, $newLocHouseNum): void {
            $sql = $this->prepare('INSERT INTO '.$GLOBALS['prefix'].'savedLocations(savedLocationRegisteredId, savedLocationCityId, savedLocationStrName, savedLocationHouseNum) VALUES (?, ?, ?, ?)');
            if($sql->bind_param('iiss', $_SESSION['id'], $newLocCityId, $newLocStrName, $newLocHouseNum)){
                $sql->execute();
            }
        }

<<<<<<< HEAD
        public function getSavedLocation($newLocCityId, $newLocStrName, $newLocHouseNum): int { //info: fetch data from db to check if saved location exists in db
            $sql = $this->prepare('SELECT savedLocationId FROM '.$GLOBALS['prefix'].'savedLocations WHERE savedLocationCityId = ? AND savedLocationStrName = ? AND savedLocationHoustNum = ?');
            if($sql->bind_param('iss', $newLocCityId, $newLocStrName, $newLocHouseNum)){
                $sql->execute();
                if($result = $sql->get_result()){
                    if($result->num_rows > 0){
                        $row = $result->fetch_assoc();
                        return $row['savedLocationId'];
                    }
                }
            }
        }

        public function addReservation($addResRoomId, $addResStartDate, $addResEndDate): void{ //info: adds a single new reservation
            $sql = $this->prepare('INSERT INTO '.$GLOBALS['prefix'].'reservations(reservationRegisteredId, reservationRoomId, reservationStartingT, reservationEndT) VALUES (?, ?, ?, ?)');
            if($sql->bind_param('iiss', $_SESSION['id'], $addResRoomId, $addResStartDate, $addResEndDate)){
                $sql->execute();
            }
        }

        public function getReservation($addResRoomId, $addResStartDate, $addResEndDate): int {
            $sql = $this->prepare('SELECT reservationId FROM '.$GLOBALS['prefix'].'reservations WHERE reservationRegisteredId = ? AND reservationRoomId = ? AND reservationStartingT = ? AND reservationEndT = ?');
            if($sql->bind_param('iiss', $_SESSION['id'], $addResRoomId, $addResStartDate, $addResEndDate)){
                $sql->execute();
                if($result = $sql->get_result()){
                    if($result->num_rows > 0){
                        $row = $result->fetch_assoc();
                        return $row['reservationId'];
                    }
                }
            }
        }

        public function newInvoice($invoiceReservId, $invoiceIssueDate, $invoicePaymentDeadline, $invoicePrePaid, $invoiceSavedLocationId): void{ //IMPORTANT: last to be run by newFullReservation function
            $sql = $this->prepare('INSERT INTO '.$GLOBALS['prefix'].'invoice(invoiceReservId, invoiceIssueDate, invoicePaymentDeadline, invoicePrePaid, invoiceSavedLocationId) VALUES (?, ?, ?, ?, ?)');
            if($sql->bind_param('issii', $invoiceReservId, $invoiceIssueDate, $invoicePaymentDeadline, $invoicePrePaid, $invoiceSavedLocationId)){
                $sql->execute();
            }
        }

        public function newFullReservation($newLocCityId, $newLocStrName, $newLocHouseNum, $addResRoomId, $addResStartDate, $addResEndDate): void{ //info: will run the whole pack of functions: addReservation, addInvoice, newSavedLocation
            $getLocationId = $this->getSavedLocation($newLocCityId, $newLocStrName, $newLocHouseNum);
            if($getLocationId > 0){
                $this->addReservation($addResRoomId, $addResStartDate, $addResEndDate);
                $getReservId = $this->getReservation($addResRoomId, $addResStartDate, $addResEndDate);
                $invoiceIssueDate = date('Y-m-d');
                $invoicePaymentDeadline = date('Y-m-d', strtotime($invoiceIssueDate. '+ 3 days'));
                $this->newInvoice($getReservId, $invoiceIssueDate, $invoicePaymentDeadline, 0, $getLocationId);
            } else {
                $this->newSavedLocation($newLocCityId, $newLocStrName, $newLocHouseNum);
                $gotNewLocationId = $this->getSavedLocation($newLocCityId, $newLocStrName, $newLocHouseNum);
                $this->addReservation($addResRoomId, $addResStartDate, $addResEndDate);
                $getReservId = $this->getReservation($addResRoomId, $addResStartDate, $addResEndDate);
                $invoiceIssueDate = date('Y-m-d');
                $invoicePaymentDeadline = date('Y-m-d', strtotime($invoiceIssueDate. '+ 3 days'));
                $this->newInvoice($getReservId, $invoiceIssueDate, $invoicePaymentDeadline, 0, $getLocationId);
            }
        }

=======
>>>>>>> parent of 3902605 (Made functions to make new db inserts.)
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

    }