<?php

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Illuminate\Database\Capsule\Manager as Capsule;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Initialize database
$capsule = new Capsule;
$capsule->addConnection(require __DIR__ . '/config/database.php');
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Start session
session_start();

// Load routes
$router = require __DIR__ . '/routes.php';

// Handle request
$request = Symfony\Component\HttpFoundation\Request::createFromGlobals();
$response = $router->dispatch($request);
$response->send();
