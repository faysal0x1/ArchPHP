<?php


function dd($data): void {
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
	die();
}

function urlIs($value): bool {
	return $_SERVER['REQUEST_URI'] === $value;

}

function redirect($path): void {
	header("Location: /{$path}");
	exit;
}



function view($view, $data = []): void {
	extract($data);
	require "views/{$view}.view.php";
}

function authorize(bool $condition, $status = Response::FORBIDDEN): void {
	if (!$condition) {
		abort($status);
	}
}