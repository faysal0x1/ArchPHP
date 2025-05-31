<?php

const BASE_PATH = __DIR__ . '/../';
require BASE_PATH . 'Core/functions.php';


spl_autoload_register(static function ($class) {
	$file = base_path("Core/" . $class . '.php');
	if (file_exists($file)) {
		require $file;
	}
});


require BASE_PATH . ('Core/router.php');



