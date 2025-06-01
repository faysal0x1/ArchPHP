<?php

use Core\Router;
use App\Controllers\AuthController;
use App\Controllers\IndexController;
use App\Controllers\DashboardController;
use App\Controllers\AboutController;
use App\Controllers\ContactController;
use App\Controllers\PostController;
use Core\Middleware\Auth as AuthMiddleware;

$router = new Router();

// Auth Routes
$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'showRegister']);
$router->post('/register', [AuthController::class, 'register']);
$router->get('/logout', [AuthController::class, 'logout']);

// Protected Routes
$router->get('/dashboard', [DashboardController::class, 'index'], [AuthMiddleware::class]);

// Public Routes
$router->get('/', [IndexController::class, 'index']);
$router->get('/about', [AboutController::class, 'index']);
$router->get('/contact', [ContactController::class, 'index']);

// Post Routes
$router->get('/posts', [PostController::class, 'index']);
$router->get('/post/create', [PostController::class, 'create']);
$router->post('/post/store', [PostController::class, 'store']);
$router->get('/post/edit', [PostController::class, 'edit']);
$router->patch('/post/update', [PostController::class, 'update']);
$router->get('/post', [PostController::class, 'show']);
$router->delete('/post/delete', [PostController::class, 'destroy']);

return $router;
