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


require BASE_PATH . ('Core/router.php');
