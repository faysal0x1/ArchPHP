<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$heading = 'Posts Page';

$posts = $db->query('SELECT * FROM posts ORDER BY created_at DESC')->get();


require view('posts/index.view.php', [
	'heading' => $heading,
	'posts' => $posts
]);
