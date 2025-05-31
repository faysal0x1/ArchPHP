<?php
require('Validator.php');

$heading = 'Create Post';
$errors = [];

$config = require 'config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$title = trim($_POST['title'] ?? '');
	$description = trim($_POST['description'] ?? '');
	$user_id = $_POST['user_id'] ?? '';
	$status = $_POST['status'] ?? 'draft';

	$validator = new Validator();

	if (!$title) {
		$errors[] = 'Title is required.';
		if ($validator->string($title)) {
			$errors[] = 'Title must be a string.';
		}
	}

	if (!$description) {
		$errors[] = 'Description is required.';
	}

	if (!$user_id || !is_numeric($user_id)) {
		$errors[] = 'Valid User ID is required.';
	}

	if (!$status || !in_array($status, ['draft', 'published'])) {
		$errors[] = 'Status must be either draft or published.';
	}

	if (empty($errors)) {
		$db = new Database($config['database'], $config['database']['username'], $config['database']['password']);
		$db->query('INSERT INTO posts (title, description, user_id, status) VALUES (:title, :description, :user_id, :status)', [
			'title' => $title,
			'description' => $description,
			'user_id' => $user_id,
			'status' => $status
		]);


		ret
	}


}


require 'views/post-create.view.php';