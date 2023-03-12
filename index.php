<?php
	require_once 'Model/Database.php';
    require_once 'Model/User.php';
	require_once 'Model/Room.php';
	require_once 'Model/Admin.php';

/*
 * Source:
 * Register controller from ChatGPT.
 * Edited to work because the response form ChatGPT was wrong.
 * https://chat.openai.com/chat
 */

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
        case '/korondi/reservation':
            $controller = new reservationController();
            $controller->reservation();
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
        case '/korondi/profile':
            $controller = new profileController();
            $controller->profile();
            break;
        case '/korondi/savedData':
            $controller = new savedDataController();
            $controller->savedData();
            break;
        case '/korondi/bookie/reservations':
            $controller = new reservationsConroller();
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
        case '/korondi/admin/newroom':
            $controller = new newroomController();
            $controller->newroom();
            break;
		case '/korondi/admin/allregs':
			$controller = new allregisteredController();
			$controller->allRegistered();
			break;
        case '/korondi/errors/noAccess':
			http_response_code(403);
			include('View/errors/403.php');
			break;
        default:
            http_response_code(404);
            include('View/errors/404.php');
            break;
	}