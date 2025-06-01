<?php

namespace App\Controllers;

use Illuminate\Database\Capsule\Manager as DB;

class PostController
{
    public function index()
    {
        $posts = DB::table('posts')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('posts/index.view.php', [
            'heading' => 'All Posts',
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts/create.view.php', [
            'heading' => 'Create Post'
        ]);
    }

    public function store()
    {
        // Debug information
        error_log('Store method called');
        error_log('POST data: ' . print_r($_POST, true));
        error_log('Request method: ' . $_SERVER['REQUEST_METHOD']);
        error_log('Request URI: ' . $_SERVER['REQUEST_URI']);
        error_log('Request headers: ' . print_r(getallheaders(), true));

        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';

        if (empty($title) || empty($description)) {
            error_log('Validation failed: Title or description is missing');
            return view('posts/create.view.php', [
                'heading' => 'Create Post',
                'errors' => ['Title and description are required'],
                'old' => [
                    'title' => $title,
                    'description' => $description
                ]
            ]);
        }

        try {
            error_log('Attempting to create new post');
            DB::table('posts')->insert([
                'title' => $title,
                'description' => $description,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            error_log('Post created successfully');

            return redirect('posts');
        } catch (\Exception $e) {
            error_log('Error creating post: ' . $e->getMessage());
            return view('posts/create.view.php', [
                'heading' => 'Create Post',
                'errors' => ['Failed to create post'],
                'old' => [
                    'title' => $title,
                    'description' => $description
                ]
            ]);
        }
    }

    public function show()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            return redirect('posts');
        }

        $post = DB::table('posts')->find($id);

        if (!$post) {
            return redirect('posts');
        }

        return view('posts/show.view.php', [
            'heading' => $post->title,
            'post' => $post
        ]);
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            return redirect('posts');
        }

        $post = DB::table('posts')->find($id);

        if (!$post) {
            return redirect('posts');
        }

        return view('posts/edit.view.php', [
            'heading' => 'Edit Post',
            'post' => $post
        ]);
    }

    public function update()
    {
        // Debug information
        error_log('Update method called');
        error_log('POST data: ' . print_r($_POST, true));
        error_log('Request method: ' . $_SERVER['REQUEST_METHOD']);
        error_log('Request URI: ' . $_SERVER['REQUEST_URI']);
        error_log('Request headers: ' . print_r(getallheaders(), true));

        $id = $_POST['id'] ?? null;
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';

        if (!$id || empty($title) || empty($description)) {
            error_log('Validation failed: ID, title, or description is missing');
            return view('posts/edit.view.php', [
                'heading' => 'Edit Post',
                'errors' => ['Title and description are required'],
                'post' => (object)[
                    'id' => $id,
                    'title' => $title,
                    'description' => $description
                ]
            ]);
        }

        try {
            error_log('Attempting to update post with ID: ' . $id);
            DB::table('posts')
                ->where('id', $id)
                ->update([
                    'title' => $title,
                    'description' => $description,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            error_log('Post updated successfully');

            return redirect('posts');
        } catch (\Exception $e) {
            error_log('Error updating post: ' . $e->getMessage());
            return view('posts/edit.view.php', [
                'heading' => 'Edit Post',
                'errors' => ['Failed to update post'],
                'post' => (object)[
                    'id' => $id,
                    'title' => $title,
                    'description' => $description
                ]
            ]);
        }
    }

    public function destroy()
    {
        // Debug information
        error_log('Destroy method called');
        error_log('POST data: ' . print_r($_POST, true));
        error_log('Request method: ' . $_SERVER['REQUEST_METHOD']);
        error_log('Request URI: ' . $_SERVER['REQUEST_URI']);
        error_log('Request headers: ' . print_r(getallheaders(), true));

        $id = $_POST['id'] ?? null;

        if (!$id) {
            error_log('No post ID provided for deletion');
            return redirect('posts');
        }

        try {
            error_log('Attempting to delete post with ID: ' . $id);
            DB::table('posts')->where('id', $id)->delete();
            error_log('Post deleted successfully');

            return redirect('posts');
        } catch (\Exception $e) {
            error_log('Error deleting post: ' . $e->getMessage());
            return redirect('posts');
        }
    }
}
