<?php

    class RegisterController {
        public function register(){
            $title = "Regisztráljon";
            require_once 'View/layout/loginHeader.php';
            require_once 'View/Users/register.php';
        }
    }