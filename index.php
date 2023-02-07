<?php
    require_once 'Model/User.php';
	require_once 'Model/Database.php';
	$db = new Database();
    $register = new User($db);

	spl_autoload_register(function ($className) {
		require_once 'Controller/'.$className.'.php';
	});

    session_start();

	$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	switch($request) {
		case '/':
			$controller = new LoginController();
			$controller->login();
			break;
        case '/register';
            $controller = new RegisterController();
            $controller->register();
            break;
		default:
			http_response_code(404);
			include('View/Users/404.php');
			break;
	}