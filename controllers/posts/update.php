<?php

use Core\Database;
use Core\Validator;
use Core\App;

$config = require base_path('config.php');
$db = App::resolve(Database::class);

$heading = 'Update Post Page';

// Get post ID from either POST or GET
$postId = $_POST['post_id'] ?? $_GET['id'] ?? null;

if (!$postId) {
    abort(404);
}

$currntUserId = 1;

// Fetch the post
$post = $db->query('SELECT * FROM posts WHERE id = :id', ['id' => $postId])
    ->findOrFail();

// authorize($post['user_id'] === $currntUserId);

// Handle the update request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'PATCH') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $status = $_POST['status'] ?? 'published'; // Default to published if not provided

    $errors = [];
    $validator = new Validator();

    // Validate title
    if (!$title) {
        $errors[] = 'Title is required.';
    } elseif (!$validator->string($title, 1, 255)) { // Assuming max length of 255
        $errors[] = 'Title must be a valid string between 1 and 255 characters.';
    }

    // Validate description
    if (!$description) {
        $errors[] = 'Description is required.';
    } elseif (!$validator->string($description, 1, 1000)) { // Assuming max length of 1000
        $errors[] = 'Description must be a valid string between 1 and 1000 characters.';
    }

    // Validate status
    if (!in_array($status, ['draft', 'published'])) {
        $errors[] = 'Status must be either draft or published.';
    }

    // If no errors, update the post
    if (empty($errors)) {
        $db->query('UPDATE posts SET title = :title, description = :description, status = :status, updated_at = NOW() WHERE id = :id', [
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'id' => $postId
        ]);

        // Redirect to posts page after successful update
        header('Location: /posts');
        exit();
    }

    // If there are errors, they will be displayed in the view
}

// Render the edit form (either initial load or with errors)
require view('posts/edit.view.php', [
    'heading' => $heading,
    'post' => $post,
    'errors' => $errors ?? []
]);
