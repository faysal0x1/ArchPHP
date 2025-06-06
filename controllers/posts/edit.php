<?php

use Core\Database;


$config = require base_path('config.php');
$db = new Database($config['database'], $config['database']['username'], $config['database']['password']);

$heading = 'Edit Post Page';


$postId = $_GET['id'] ?? null;

$currntUserId = 1;

$post = $db->query('SELECT * FROM posts WHERE id = :id', ['id' => $postId])
    ->findOrFail();

// authorize($post['user_id'] === $currntUserId);

require view('posts/edit.view.php', [
    'heading' => $heading,
    'post' => $post
]);
