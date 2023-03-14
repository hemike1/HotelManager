<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'Assets/plugins/PHPMailer/src/Exception.php';
require 'Assets/plugins/PHPMailer/src/PHPMailer.php';
require 'Assets/plugins/PHPMailer/src/SMTP.php';
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
        //require_once 'View/Users/review.php';
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
            $roomData = $room->getRoomData($addResRoomId);

            $mail = new PHPMailer(true);
            $message = file_get_contents('Assets/email/reservation.html');

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host = 'mail.nethely.hu';                      //Set the SMTP server to send through
                $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                $mail->Username = 'hms@hemike.hu';                        //SMTP username
                $mail->Password = '2Kecske9801@';                         //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                $mail->CharSet = 'UTF-8';

                //Recipients
                $mail->setFrom('no-reply@HMS.hu', 'HMS No-Reply');
                $mail->addAddress($user->getEmail(), $user->getFirstname()." ".$user->getLastname());     //Add a recipient
                $mail->addReplyTo('hms@hemike.hu', 'HMS Info');
                $mail->addBCC('kris.kristof1@gmail.com');

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Sikeres szoba foglalás!';
                $mail->Body = 'This is the HTML message body <b>in bold!</b>';
                $mail->AddEmbeddedImage("Assets/images/rooms/".$roomData['image'], "roomPic", $roomData['image']);
                $mail->Body = 'Embedded Image: <img alt="'.$roomData['image'].'" src="cid:roomPic">';
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
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

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $admin->moveShowroomImage($imageID);
        }

        require_once 'View/layout/mainHeader.php';
        require_once 'View/layout/sidebar.php';
        require_once 'View/Users/images.php';
        require_once 'View/layout/footer.php';
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
        //require_once 'View/Users/contacts.php';
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
        //require_once 'View/Users/access.php';
        require_once 'View/layout/footer.php';
    }
}