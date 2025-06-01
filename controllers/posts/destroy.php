<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database'], $config['database']['username'], $config['database']['password']);

$heading = 'Post Page';

$postId = $_POST['post_id'] ?? null;

// Remove the dd($postId); line - it stops execution!

if ($postId) {
    $post = $db->query('SELECT * FROM posts WHERE id = :id', ['id' => $postId])
        ->findOrFail();

    // authorize($post['user_id'] === 1);

    $db->query('DELETE FROM posts WHERE id = :id', ['id' => $postId]);

    redirect('posts');
} else {
    // Handle case where no post_id is provided
    redirect('posts');
}
