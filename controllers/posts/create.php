<?php

use Core\Database;
use Core\Validator;


$heading = 'Create Post';
$errors = [];

$config = require base_path('config.php');



require view('posts/create.view.php', [
	'heading' => $heading,
]);
