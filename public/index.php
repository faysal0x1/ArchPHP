<?php

const BASE_PATH = __DIR__ . '/../';
require BASE_PATH . 'functions.php';
//require base_path('Response.php');
//require base_path('Database.php');

spl_autoload_register(static function ($class) {
	$file = base_path("Core/" . $class . '.php');
	if (file_exists($file)) {
		require $file;
	}
});


require base_path('router.php');



