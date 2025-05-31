<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = [
	'/' => 'controllers/index.php',
	'/about' => 'controllers/about.php',
	'/contact' => 'controllers/contact.php',
	'/posts' => 'controllers/posts.php',
	'/post' => 'controllers/post.php',
];


function routeToController($uri, $routes): void {
	if (array_key_exists($uri, $routes)) {
		require $routes[$uri];
	} else {
		abort('Page not found', 404);
	}

}

function abort( $code = 404) {
	http_response_code($code);
	require "views/{$code}.view.php";
	exit;
}

routeToController($uri, $routes);
