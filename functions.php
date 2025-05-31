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