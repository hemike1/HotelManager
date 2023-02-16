<?php
    require_once 'Model/User.php';
	require_once 'Model/Database.php';
	$db = new Database();
    $register = new User($db);
    $prefix = "/korondi";

	spl_autoload_register(function ($className) {
		require_once 'Controller/'.$className.'.php';
	});

    session_start();

    if(isset($_GET['logout'])) {
        session_unset();
        echo 'Kilépés sikeres.';
    }

	$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	switch($request) {
		case '/korondi/':
			$controller = new LoginController();
			$controller->login();
			break;
		case '/korondi/login':
			$controller = new LoginController();
			$controller->login();
			break;
        case '/korondi/register':
            $controller = new RegisterController();
            $controller->register();
            break;
        case '/korondi/home':
			$controller = new HomeController();
			$controller->home();
			break;
        default:
            http_response_code(404);
            include('View/Users/404.php');
            break;
	}