<?php

const BASE_PATH = __DIR__ . '/../';
require BASE_PATH . 'Core/functions.php';


spl_autoload_register(static function ($class) {
	$class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

	$file = BASE_PATH . $class . '.php';

	if (file_exists($file)) {
		require $file;
	}
});


//require BASE_PATH . ('Core/router.php');


$router = new Core\Router();
$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$method = $_SERVER['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);
