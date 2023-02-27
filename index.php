<?php
	require_once 'Model/Database.php';
    require_once 'Model/User.php';

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
		case '/korondi/login':
		case '/korondi/':
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
		case '/korondi/logout':
			$controller = new LoginController();
			$controller->logout();
			break;
        case '/korondi/review':
            $controller = new reviewConroller();
            $controller->review();
            break;
        case '/korondi/contacts':
            $controller = new contactsController();
            $controller->contacts();
            break;
        case '/korondi/access':
            $controller = new accessConroller();
            $controller->access();
            break;
        case '/korondi/images':
            $controller = new imagesConroller();
            $controller->images();
            break;
        case '/korondi/bookie/reservations':
            $controller = new reservationConroller();
            $controller->reservation();
            break;
        case '/korondi/admin/allreserv':
            $controller = new allreservConroller();
            $controller->allReserv();
            break;
        case '/korondi/admin/usermgmt':
            $controller = new usermgmtConroller();
            $controller->userMgmt();
            break;
        case '/korondi/errors/noAccess':
        default:
            http_response_code(404);
            include('View/Users/404.php');
            break;
	}