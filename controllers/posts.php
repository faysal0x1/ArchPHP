<?php

$config = require base_path('config.php');

$db = new Database($config['database'], $config['database']['username'], $config['database']['password']);


$heading = 'Posts Page';

$posts = $db->query('SELECT * FROM posts')->get();


require view('posts.view.php', [
	'heading' => $heading,
	'posts' => $posts
]);
