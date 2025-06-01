<?php

use Core\Response;
use Core\Validator;

function dd($data): void
{
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
	die();
}

function urlIs($value): bool
{
	return $_SERVER['REQUEST_URI'] === $value;
}

function redirect($path): void
{
	header("Location: /{$path}");
	exit;
}


function authorize(bool $condition, $status = Response::FORBIDDEN): void
{
	if (!$condition) {
		abort($status);
	}
}

function abort($status = Response::NOT_FOUND): void
{
	http_response_code($status);
	require base_path("views/{$status}.view.php");
	exit;
}

function base_path($path = ''): string
{
	return BASE_PATH . $path;
}

function view($path, $data = []): string
{
	extract($data);

	ob_start();
	require base_path("views/{$path}");
	return ob_get_clean();
}


function route($path, $callback): void
{
	$path = trim($path, '/');
	$uri = trim($_SERVER['REQUEST_URI'], '/');

	if ($uri === $path) {
		$callback();
		exit;
	}
}
