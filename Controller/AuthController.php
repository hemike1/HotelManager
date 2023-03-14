<?php

class AuthController extends Database {
    public function register(){
        $title = "Regisztrálás";
        $db = new Database();
        $user = new User($db);
        if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password'])) {
            $firstName = $_POST['firstname'];
            $lastName = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user->register($firstName, $lastName, $email, $password);
        }
        require_once 'View/layout/loginHeader.php';
        require_once 'View/Users/register.php';
        require_once 'View/layout/footer.php';
    }

    public function login() {
        $title = "Bejelentkezés";
        $db = new Database();
        $user = new User($db);
        if(isset($_SESSION['id'])){
            header('Location: /korondi/home');
        } else if(isset($_POST['email']) && isset($_POST['password'])) {
            $response = $user->checkLogin($_POST['email'], $_POST['password']);
            if(!empty($response)){
                foreach ($response as $key => $value){
                    $$key = $value;
                }
            } else {
                header('Location: /korondi/home');
            }
        }
        require_once 'View/layout/loginHeader.php';
        require_once 'View/Users/login.php';
        require_once 'View/layout/footer.php';
    }

    public function logout(){
        session_destroy();
        header('Location: /korondi/');
    }
}