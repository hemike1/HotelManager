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
			$controller = new AuthController();
			$controller->login();
			break;
		case '/korondi/register':
            $controller = new AuthController();
            $controller->register();
            break;
        case '/korondi/home':
			$controller = new UserController();
			$controller->home();
			break;
        case '/korondi/reservation':
            $controller = new UserController();
            $controller->reservation();
            break;
		case '/korondi/logout':
			$controller = new AuthController();
			$controller->logout();
			break;
        case '/korondi/review':
            $controller = new UserController();
            $controller->review();
            break;
        case '/korondi/contacts':
            $controller = new UserController();
            $controller->contacts();
            break;
        case '/korondi/access':
            $controller = new UserController();
            $controller->access();
            break;
        case '/korondi/images':
            $controller = new UserController();
            $controller->images();
            break;
        case '/korondi/profile':
            $controller = new UserController();
            $controller->profile();
            break;
        case '/korondi/savedData':
            $controller = new UserController();
            $controller->savedData();
            break;
        case '/korondi/bookie/reservations':
            $controller = new AdminController();
            $controller->reservation();
            break;
        case '/korondi/admin/allreserv':
            $controller = new AdminController();
            $controller->allReserv();
            break;
        case '/korondi/admin/usermgmt':
            $controller = new AdminController();
            $controller->userMgmt();
            break;
        case '/korondi/admin/newroom':
            $controller = new AdminController();
            $controller->newroom();
            break;
		case '/korondi/admin/allregs':
			$controller = new AdminController();
			$controller->allRegistered();
			break;
        case '/korondi/errors/noAccess':
			$controller = new ErrorController();
            $controller->noAccess();
			break;
        default:
            $controller = new ErrorController();
            $controller->notFound();
            break;
	}