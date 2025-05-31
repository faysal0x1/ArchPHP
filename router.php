<?php
$routes = require 'routes.php';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

function routeToController($uri, $routes): void {
	if (array_key_exists($uri, $routes)) {
		require $routes[$uri];
	} else {
		abort('Page not found', 404);
	}

}

function abort($code = 404) {
	http_response_code($code);
	require "views/{$code}.view.php";
	exit;
}

routeToController($uri, $routes);
